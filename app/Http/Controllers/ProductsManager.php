<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsManager extends Controller
{
    function index(Request $request){
        $query = Products::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Sort functionality
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name':
                    $query->orderBy('title', 'asc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
            }
        }

        $products = $query->paginate(8);
        return view('products', compact('products'));
    }

    function details($slug){
        $product = Products::where('slug',$slug)->first();
        return view('details',compact('product'));
    }
    function addToCart(Request $request, $id){
        // Get quantity from request, default to 1
        $quantity = $request->input('quantity', 1);

        // Validate quantity
        if ($quantity < 1 || $quantity > 99) {
            return redirect()->back()->with('error', 'Invalid quantity');
        }

        // Check if product exists
        $product = Products::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        try {
            // Add items to cart based on quantity
            for ($i = 0; $i < $quantity; $i++) {
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
                $cart->product_id = $id;
                $cart->save();
            }

            $message = $quantity == 1 ? 'Product added to cart successfully' : $quantity . ' products added to cart successfully';

            // Change this line to redirect to cart instead of back
            return redirect()->route('cart.show')->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    function showCart()
    {
        $cartItems = DB::table("cart")
            ->join('products','cart.product_id', '=','products.id')
            ->select(
                "cart.product_id",
                DB::raw("count(*) as quantity"),
                'products.title',
                'products.price',
                'products.image',
                'products.slug',
                DB::raw("(products.price * count(*)) as subtotal")
            )
            ->where("cart.user_id", auth()->user()->id)
            ->groupBy("cart.product_id","products.title",'products.price','products.image','products.slug')
            ->paginate(5);

        // Calculate total
        $total = DB::table("cart")
            ->join('products','cart.product_id', '=','products.id')
            ->where("cart.user_id", auth()->user()->id)
            ->sum(DB::raw('products.price'));

        return view('cart', compact('cartItems', 'total'));
    }

    function clearCart() {
        try {
            Cart::where('user_id', auth()->user()->id)->delete();
            return redirect()->back()->with('success', 'Cart cleared successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    function removeFromCart(Request $request, $productId) {
        try {
            $userId = auth()->user()->id;
            $quantity = $request->input('quantity', 1);

            // Get cart items for this product
            $cartItems = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->limit($quantity)
                ->get();

            if ($cartItems->count() > 0) {
                // Delete the specified quantity
                foreach ($cartItems as $item) {
                    $item->delete();
                }

                $message = $quantity == 1 ? 'Item removed from cart' : $quantity . ' items removed from cart';
                return redirect()->back()->with('success', $message);
            }

            return redirect()->back()->with('error', 'Item not found in cart');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }





}
