<?php
namespace App\Http\Controllers;

use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{
    public function addtocart(Request $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');

        if(Auth::check())
        {
            $prod_check=Product::where('id',$product_id)->first();

            if($prod_check)
            {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $minicart=view('frontend.minicart')->render();
                    return response()->json(['status' => $prod_check->name." Already Added To Cart!!   Plese Check Your Cart..", 'minicart'=>$minicart]);
                }
                else
                {
                    $cartItem = new Cart();
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_id = $product_id;
                    $cartItem->qty = $qty;
                    $cartItem->save();
                    $minicart=view('frontend.minicart')->render();
                    return response()->json(['status' => $prod_check->name." Added To Cart!!",'minicart'=>$minicart]);
                }
            }
        }
        else
        {
            return response()->json(['status'=>"Please! Login To Continue..."]);
            //session(['product_id'=>$product_id,'qty'=>$qty]);

        }
    }

    public function viewCart()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view("frontend.cart", compact('cartitems'));
    }

    public function removecart(Request $request)
    {
        if(Auth::check())
        {
            $product_id = $request->input('product_id');
            if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                $cartitems = Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $cartitems->delete();
                return response()->json(['status'=>"Product Removed From your Cart"]);
            }
        }
        else
        {
            return response()->json(['status'=>"Login To Continue!!"]);
        }

    }
    public function updatecart(Request $request)
    {
        $product_id= $request->input('product_id');
        $product_qty= $request->input('qty');

        if(Auth::check())
        {

            $qty = Product::where('id',$product_id)->first(['stock']);

            if($product_qty <= 5 && $product_qty < $qty->stock && $product_qty > 0 )
            {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $cart= Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                    $cart->qty= $product_qty;
                    $cart->update();
                    $product_price = $cart->product->price;
                    $minicart=view('frontend.minicart')->render();
                    return response()->json(['status'=>"Quantity updated!",'cart'=>$cart,'product_price'=>$product_price,'minicart'=>$minicart]);
                }
            }
            else
            {
                return response()->json(['status'=>"Quantity Is Not Valid!!"]);
            }

        }
    }

    public function minicart(Request $request)
    {
    }

}
