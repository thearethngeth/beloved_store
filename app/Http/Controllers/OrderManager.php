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
        return "success" . $order_id;
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


}
