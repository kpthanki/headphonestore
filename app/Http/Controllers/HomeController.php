<?php

namespace App\Http\Controllers;

use App\Modules\Product\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role=Auth::user()->role;

        if ($role=="Admin") {
            return view('admin.dashboard');
        }
        else
        {
            $product_id = session('product_id');
            $qty = session('qty');
            $product_check = Product::where('id', $product_id)->first();

            if($product_check)
            {
                $cartitem = new Cart();
                $cartitem->product_id = $product_id;
                $cartitem->user_id = Auth::id();
                $cartitem->qty = $qty;
                $cartitem->save();
            }
            return view('frontend.home');
        }
    }
}
