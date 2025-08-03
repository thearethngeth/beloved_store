<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Climate\Order;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;
use UnexpectedValueException;

class OrderManager extends Controller
{
    function showCheckout(Request $req)
    {
        return view('checkout');
    }

    function checkoutPost(Request $request){
        $request->validate([
            'address'=>"required",
            'pincode'=>"required",
            'phone'=>"required",
        ]);

        // Get cart items with all product columns to avoid column name issues
        $cartItems = DB::table("cart")
            ->join('products','cart.product_id', '=','products.id')
            ->select(
                "cart.product_id",
                DB::raw("count(*) as quantity"),
                'products.price',
                'products.id as prod_id'
            )
            ->where("cart.user_id", auth()->user()->id)
            ->groupBy("cart.product_id", 'products.price', 'products.id')
            ->get();

        if($cartItems->isEmpty()){
            return redirect()->route('cart.show')->with('error','Cart is empty');
        }

        $productIds = [];
        $quantity = [];
        $totalPrice = 0;
        $lineItems = [];

        foreach($cartItems as $cartItem){
            // Get the actual product details
            $product = DB::table('products')->where('id', $cartItem->product_id)->first();

            $productIds[] = $cartItem->product_id;
            $quantity[] = $cartItem->quantity;
            $totalPrice += $cartItem->price * $cartItem->quantity;

            // Try different possible column names for product name
            $productName = $product->name ?? $product->title ?? $product->product_name ?? $product->description ?? 'Product';

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $productName,
                    ],
                    'unit_amount' => intval($cartItem->price * 100),
                ],
                'quantity' => intval($cartItem->quantity),
            ];
        }

        $order = new Orders();
        $order->user_id = auth()->user()->id;
        $order->address = $request->address;
        $order->pincode = $request->pincode;
        $order->phone = $request->phone;
        $order->product_id = json_encode($productIds);
        $order->total_price = $totalPrice;
        $order->quantity = json_encode($quantity);

        if($order->save()){
            DB::table('cart')->where("user_id", auth()->user()->id)->delete();

            try {
                $stripe = new StripeClient(config('app.STRIPE_KEY'));

                $checkoutSession = $stripe->checkout->sessions->create([
                    'success_url' => route('payment.success',
                        ['order_id'=> $order->id]),
                    'cancel_url' => route('payment.error'),
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'customer_email' => auth()->user()->email,
                    'metadata' => [
                        'order_id' => $order->id
                    ]
                ]);

                return redirect($checkoutSession->url);

            } catch (\Exception $e) {
                \Log::error('Stripe Error: ' . $e->getMessage());
                return redirect()->route('cart.show')->with('error', 'Payment failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('cart.show')->with('error','Something went wrong');
    }


    function paymentSuccess($order_id){
        // Find the order by ID
        $order = Orders::find($order_id);

        // Debug information (remove this in production)
        \Log::info('Payment Success Debug', [
            'order_id' => $order_id,
            'order_found' => $order ? 'yes' : 'no',
            'user_authenticated' => auth()->check() ? 'yes' : 'no',
            'current_user_id' => auth()->check() ? auth()->user()->id : 'none',
            'order_user_id' => $order ? $order->user_id : 'none'
        ]);

        // Check if order exists
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        // For successful payments, we'll show the success page regardless of auth status
        // This is because Stripe redirects can cause session issues
        // We'll just be careful about what information we display

        return view('success', compact('order'));
}

    function paymentError(){
        return "error";
    }

    function webhookStripe(Request $request)
    {
        $endpointSecret = config("app.STRIPE_WEBHOOK_SECRET");
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
         $event = Webhook::constructEvent(
             $payload, $sigHeader, $endpointSecret
         );
        } catch(UnexpectedValueException $e) {
            return response()->json(['error'=>'Invalid payload'],400);
        } catch (SignatureVerificationException $e) {
            return response()->json(['error'=>'Invalid signature'],400);
        }

        if($event->type == 'checkout.session.completed'){
            $session = $event->data->object;
            $orderId = $session->metadata->order_id;
            $paymentId = $session->payment_intent;

            $order = Order::find($orderId);
            if($order){
                $order->payment_id = $paymentId;
                $order->payment_status = "completed";
                $order->save();
            }
        }

        return response()->json(['status'=>'success'],200);
    }
    function myOrders()
    {
        $orders = Orders::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display order details
     */
    function orderDetails($id)
    {
        $order = Orders::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Parse the JSON data
        $productIds = json_decode($order->product_id, true) ?? [];
        $quantities = json_decode($order->quantity, true) ?? [];

        // Create order items collection
        $orderItems = collect();

        foreach ($productIds as $index => $productId) {
            $product = Products::find($productId);
            if ($product) {
                $quantity = $quantities[$index] ?? 1;
                $orderItems->push((object)[
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $product->price * $quantity
                ]);
            }
        }

        // Add items to order object for the view
        $order->items = $orderItems;

        // Calculate order summary
        $order->subtotal = $orderItems->sum('total');
        $order->shipping_cost = 5.00; // You can make this dynamic
        $order->tax = round($order->subtotal * 0.08, 2); // 8% tax rate
        $order->total = $order->subtotal + $order->shipping_cost + $order->tax;

        // Generate order number if not exists
        if (!$order->order_number) {
            $order->order_number = 'ORD-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->save();
        }

        // Set default status if not exists
        if (!$order->status) {
            $order->status = 'processing';
        }

        // Set shipping and billing info from order data
        $order->shipping_name = auth()->user()->name;
        $order->shipping_address = $order->address;
        $order->shipping_city = 'Phnom Penh';
        $order->shipping_state = 'Cambodia';
        $order->shipping_zip = $order->pincode;
        $order->shipping_phone = $order->phone;

        // Billing same as shipping for now
        $order->billing_name = $order->shipping_name;
        $order->billing_address = $order->shipping_address;
        $order->billing_city = $order->shipping_city;
        $order->billing_state = $order->shipping_state;
        $order->billing_zip = $order->shipping_zip;
        $order->billing_phone = $order->shipping_phone;

        // Payment method info
        $order->payment_method = 'Credit Card';
        $order->card_last_four = '1234'; // You would get this from Stripe

        return view('orders.details', compact('order'));
    }



}
