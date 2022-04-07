<?php

namespace App\Http\Controllers;
use App\Models\Billing_address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_detail;
use App\Modules\Product\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $address = Billing_address::where('user_id', Auth::user()->id)->get();
        return view('frontend.checkout_step1',compact('address'));
    }
    public function shipping()
    {
        $address = Billing_address::where('user_id', Auth::user()->id)->get();
        return view('frontend.checkout_step2',compact('address'));
    }
    public function add(Request $request)
    {
        $billing_id = $shipping_id = '';

        if ($request->addresses == 0) {
            $data = [
                'user_id' => Auth::user()->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile_number' =>$request->mobile_number,
                'state' =>$request->state,
                'city' =>$request->city,
                'pincode' => $request->pincode,
                'address' => $request->address
            ];

            $id = Billing_address::create($data);

            $billing_id = $id->id;
        }
        else
        {
            $billing_id = $request->addresses;
        }

        if(isset($request->shipping) && $request->shipping == 1){
            $shipping_id = $billing_id;
        }
        $checkout_arr= [
            'billing_id'=> $billing_id,
            'shipping_id'=> $shipping_id,
        ];

        session()->put('id', $checkout_arr);

        if($request->shipping == 1){
            return redirect('/payment');
        }
        else{
            return redirect('/shipping');
        }
    }

    public function getShipping(Request $request)
    {
       //$billing_id = $shipping_id = '';
       $session_store = session('id');
        $billing_id = (int) $session_store['billing_id'];

        if ($request->addresses == 0) {

            $data = [
                'user_id' => Auth::user()->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile_number' =>$request->mobile_number,
                'state' =>$request->state,
                'city' =>$request->city,
                'pincode' => $request->pincode,
                'address' => $request->address
            ];

            $id = Billing_address::create($data);
            $shipping_id = $id->id;
        }
        else
        {
            $shipping_id = $request->addresses;
        }

        if(isset($request->shipping) && $request->shipping = 1){
            $shipping_id = $shipping_id;
        }
        $checkout_arr= [
            'billing_id'=> $billing_id,
            'shipping_id'=> $shipping_id,
        ];
          session()->put('id', $checkout_arr);
          return redirect('/payment');
    }

    public function payment()
    {
        return view("frontend.payment");
    }

    public function orderreview()
    {
        $session_store = session('id');
        $billing_id = (int) $session_store['billing_id'];
       $shipping_id = (int) $session_store['shipping_id'];
    //    dd($billing_id,$shipping_id);

    $billing = Billing_address::where('id',$billing_id)->where('user_id', Auth::user()->id)->get();
    $shipping = Billing_address::where('id',$shipping_id)->where('user_id', Auth::user()->id)->get();

    $address = Billing_address::where('user_id', Auth::user()->id)->get();
    return view('frontend.order-review',compact('address', 'billing', 'shipping'));
    }

    public function store_order(Request $request)
    {

        $store_session_value = session('id');

        $billing_id = (int)$store_session_value['billing_id'];
        $shipping_id = (int)$store_session_value['shipping_id'];


        $order_data = Order::create([
            'user_id' => Auth::user()->id,
            'shipping_id' => $shipping_id,
            'billing_id' => $billing_id,
            'payment_id' => 'Cash On Delivery',
            'total_price' => $request->total_price,
            'order_status' => 'pending',

        ]);

        foreach ($request->product_id as $key => $value) {
            Order_detail::insert([
                'order_id' => $order_data->id,
                'product_id' => $value,
                'qty' => $request->qty[$key],
                'total_price' => $request->sub_total[$key],
            ]);
        }
        $Product_id = Product::where('id', $value)->decrement('stock', $request->qty[$key]);

        Cart::where('User_id', Auth::user()->id)->delete();

        return redirect('/');
    }
 }
