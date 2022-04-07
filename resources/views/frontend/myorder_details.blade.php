@extends('frontend.front-master')
@section('frontcontent')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"><a href="/" title="Go to Home Page">Home</a></li>
                    <li><strong>My Orders</strong></li>
                </ul>
            </div>
        </div>
        <!--- .breadcrumbs-->
        <div class="container">
            <div class="content-top no-border">
                <h2>My Orders</h2>
                @foreach ($product_details as $order_detail)
                    <div class="blog-mansory" style="position: relative; height: 1775.03px; max-width: 100%">
                        <div class="blog-mansory-item" style="position:inherit !important;max-width: 100%">
                            <div class="blog-mansory-item-content" style="border: solid #e1e1e3;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right" style="margin-bottom: 10px">
                                            Date & Time:{{ $order_detail->created_at }}
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-md-4">
                                                <div class="card m-b-20">
                                                    <div class="card-header">
                                                        <h3>Billing Address</h3>
                                                    </div>
                                                    <div class="card-block">
                                                        <h4>{{ $order_detail->name }}</h4>
                                                        <h6 class="card-subtitle text-muted">
                                                            {{ $order_detail->billing_address->name }}</h6>
                                                        <p class="card-text">
                                                            {{ $order_detail->billing_address->mobile_number }}<br>
                                                            {{ $order_detail->billing_address->address }}
                                                            {{ $order_detail->billing_address->city }},{{ $order_detail->billing_address->state }}
                                                            ,{{ $order_detail->billing_address->pincode }}<br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card m-b-20">
                                                    <div class="card-header" style="font-weight: bold">
                                                        <h3>Shipping Address</h3>
                                                    </div>
                                                    <div class="card-block">
                                                        <h4>{{ $order_detail->name }}</h4>
                                                        <h6 class="card-subtitle text-muted">
                                                            {{ $order_detail->shipping_address->name }}</h6>
                                                        <p class="card-text">
                                                            {{ $order_detail->shipping_address->mobile_number }}<br>
                                                            {{ $order_detail->shipping_address->address }}
                                                            {{ $order_detail->shipping_address->city }},{{ $order_detail->shipping_address->state }}
                                                            ,{{ $order_detail->shipping_address->pincode }}<br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3>Payment Information</h3>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="font-weight-bold">
                                                            Method:
                                                            <span class="font-weight-normal">Cash On Delivey</span>
                                                        </div>
                                                        <div class="col-12"><br><br>
                                                            <button type="button" class="btn btn-light"
                                                                style="float: right;"><a href="{{ url('/viewproducts',[$order_detail->Id]) }}">
                                                                <i class="fa fa-eye fa-lg"></i> &nbsp;View Products</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="width: 100%;border-bottom: solid #e1e1e3;margin-bottom: 10px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom text-right"
                                style="border: solid #e1e1e3; background-color:#955251; color:white;">
                                <div class="col-50" style="width: 30%"><b>Order
                                        Status:&nbsp;{{ $order_detail->order_status }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--- .container-->
    </div>
    <!--- .main-container -->
@endsection
