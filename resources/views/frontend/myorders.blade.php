@extends('frontend.front-master')
@section('frontcontent')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="" title="Go to Home Page">Home</a></li>
                    <li class="category4"><a href="{{ route('frontend.slider') }}">HEADPHONES</a></li>
                    <li> <strong>My Orders</strong></li>
                </ul>
            </div>
        </div>
        <!--- .breadcrumbs-->
        <div class="container">
            <div class="content-top no-border">
                <h2>My Orders</h2>
            </div>
            <div class="table-responsive-wrapper product_list product_data">
                <table class="table-order table-wishlist">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Image</td>
                            <td>quantity</td>
                            <td>price</td>
                            <td>Address</td>
                            <td>Ordered Date</td>
                            <td>Delivered On</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order as $item)
                        <tr>
                            <td><a href="{{ $item->product->url }}" title="{{ $item->product->url }}"></td>
                        </tr>
                            @php
                                $total += $item->product->price * $item->qty;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-left">
                                <h1>Total Price: <b>{{ $total }}/-</b></h1>
                            </td>
                        </tr>
                        <td colspan="3" class="text-right">
                            <a href="{{ url('/checkout') }}" class="btn-step checkout">Checkout</a>
                        </td>
                    </tbody>
                </table>
            </div>
            <!--- .table-responsive-wrapper-->
        </div>
        <!--- .container-->
    </div>
    <!--- .main-container -->
@endsection
