<?php

namespace App\Modules\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Billing_address;
use App\Models\Order_detail;
use App\Modules\Orders\Models\Orders;

use Illuminate\Http\Request;

class OrdersController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $order=Order::get();
        return view("Orders::welcome",compact('order'));
    }

    public function invoice($id)
    {
        $order= Order::where('id',$id)->get();
        $order_detail=Order_detail::where('order_id',$id)->get();
        return view("Orders::invoice",compact('order','order_detail'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('Orders::edit', compact('order'));
    }
    public function update(request $request,$id)
    {
        Order::where('Id',$id)->update(['order_status'=>$request->order_status]);
        return redirect('/admin/vieworder')->with('success','Item Updated successfully!');
        $data=Order::all();
    }


}
