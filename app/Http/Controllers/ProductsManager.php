<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsManager extends Controller
{
    function index(){
        // Reset to 8 products per page for better display
        $products = Products::paginate(8);
        return view('products',compact('products'));
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
            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    function showCart()
    {
       $cartItems = DB::table("cart")
           ->join('products','cart.product_id',
               '=','products.id')
           ->select(
               "cart.product_id",
               DB::raw("count(*) as quantity"),
               'products.title',
               'products.price',
               'products.image',
               'products.slug'
           )
           ->where("cart.user_id", auth()->user()->id)
               ->groupBy("cart.product_id","products.title",'products.price','products.image','products.slug')
           ->paginate(5);
       return view('cart',compact('cartItems'));
    }


}
