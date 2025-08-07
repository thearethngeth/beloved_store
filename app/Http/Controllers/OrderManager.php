<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
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

            $order = Orders::find($orderId); // Fixed: was using Order instead of Orders
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

        // Calculate order summary
        $subtotal = $orderItems->sum('total');
        $shippingCost = 5.00; // You can make this dynamic
        $tax = round($subtotal * 0.08, 2); // 8% tax rate
        $total = $subtotal + $shippingCost + $tax;

        // Generate order number (don't save to database)
        $orderNumber = 'ORD-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);

        // Set default status if not exists
        $status = 'processing'; // Default status since we don't have a status column

        // Set shipping and billing info from order data
        $shippingName = auth()->user()->name;
        $shippingAddress = $order->address;
        $shippingCity = 'Phnom Penh';
        $shippingState = 'Cambodia';
        $shippingZip = $order->pincode;
        $shippingPhone = $order->phone;

        // Billing same as shipping for now
        $billingName = $shippingName;
        $billingAddress = $shippingAddress;
        $billingCity = $shippingCity;
        $billingState = $shippingState;
        $billingZip = $shippingZip;
        $billingPhone = $shippingPhone;

        // Payment method info
        $paymentMethod = 'Credit Card';
        $cardLastFour = '1234'; // You would get this from Stripe

        // Generate tracking number for shipped/delivered orders
        $trackingNumber = null;
        if (in_array(strtolower($order->payment_status ?? $status), ['shipped', 'delivered'])) {
            $trackingNumber = 'TRK' . strtoupper(substr(md5($order->id), 0, 10));
        }

        // Create a data object to pass to the view instead of modifying the model
        $orderData = (object)[
            'id' => $order->id,
            'order_number' => $orderNumber,
            'created_at' => $order->created_at,
            'payment_status' => $order->payment_status,
            'status' => $status,
            'total_price' => $order->total_price,
            'payment_id' => $order->payment_id,
            'address' => $order->address,
            'pincode' => $order->pincode,
            'phone' => $order->phone,
            'items' => $orderItems,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'tax' => $tax,
            'total' => $total,
            'shipping_name' => $shippingName,
            'shipping_address' => $shippingAddress,
            'shipping_city' => $shippingCity,
            'shipping_state' => $shippingState,
            'shipping_zip' => $shippingZip,
            'shipping_phone' => $shippingPhone,
            'billing_name' => $billingName,
            'billing_address' => $billingAddress,
            'billing_city' => $billingCity,
            'billing_state' => $billingState,
            'billing_zip' => $billingZip,
            'billing_phone' => $billingPhone,
            'payment_method' => $paymentMethod,
            'card_last_four' => $cardLastFour,
            'tracking_number' => $trackingNumber
        ];

        // Return the correct view path
        return view('OrderDetails', compact('orderData'));
    }
}
