@extends('frontend.front-master')
    @section('frontcontent')
    <div class="wrapper">
        <div class="page">
            <div class="main-container col1-layout content-color color">
                <div class="breadcrumbs">
                    <div class="container">
                        <ul>
                            <li class="home"> <a href="#" title="Go to Home Page">Home</a></li>
                            <li> <strong>Checkout</strong></li>
                        </ul>
                    </div>
                </div>
                <!--- .breadcrumbs-->

                <div class="woocommerce">
                    <div class="container">
                        <div class="content-top">
                            <h2>Checkout</h2>
                            <p>Need to Help? Call us: +9 123 456 789 or Email: <a
                                    href="mailto:Support@Rosi.com">Support@Rosi.com</a></p>
                        </div>
                        <div class="checkout-step-process">
                            <ul>
                                <li>
                                    <div class="step-process-item"><i data-href="checkout-step2.html"
                                            class="redirectjs  step-icon fa fa-check"></i><span
                                            class="text">Billing Address</span></div>
                                </li>
                                <li>
                                    <div class="step-process-item"><i class="fa fa-check step-icon "></i><span
                                            class="text">Shipping Address</span></div>
                                </li>

                                <li>
                                    <div class="step-process-item "><i data-href="checkout-step4.html"
                                            class="redirectjs  step-icon fa fa-check"></i><span
                                            class="text">Delivery & Payment</span></div>
                                </li>
                                <li>
                                    <div class="step-process-item active"><i data-href="checkout-step5.html"
                                            class="redirectjs  step-icon icon-notebook"></i><span
                                            class="text">Order Review</span></div>
                                </li>

                                <li>

                                </li>
                            </ul>
                        </div>
                        <!--- .checkout-step-process --->
                        <form action="{{ url('/placeorder') }}" method="POST" name="placeorder_form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <ul class="row">
                                <li class="col-md-9 col-padding-right">
                                    <table class="table-order table-order-review">
                                        <thead>
                                            <tr>
                                                <td width="68">Product Name</td>
                                                <td width="14">price</td>
                                                <td width="14">QTY</td>
                                                <td width="14">Total</td>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @php $total=0 @endphp

                                            @foreach ($cartitems as $item)
                                                @php $total += $item->qty * $item->product->price @endphp


                                                <tr>
                                                    <td class="name">{{ $item->product->name }}</td>
                                                    <input type="hidden" name="product_id[]"
                                                        value="{{ $item->product_id }}">

                                                    <td>{{ $item->product->price }}</td>
                                                    <input type="hidden" name="price[]"
                                                        value="{{ $item->product->price }}">

                                                    <td>{{ $item->qty }}</td>
                                                    <input type="hidden" name="qty[]" value="{{ $item->qty }}">

                                                    <td class="price">{{ $item->qty * $item->product->price }}
                                                    </td>
                                                    <input type="hidden" name="sub_total[]"
                                                        value="{{ $item->qty * $item->product->price }}">

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <table class="table-order table-order-review-bottom">

                                        <tr>
                                            <td class="first large" width="80%">Total Payment</td>
                                            <td class="price large" width="20%">{{ $total }}</td>
                                            <input type="hidden" name="total_price" value="{{ $total }}">
                                        </tr>
                                        <tfoot>
                                            <td colspan="2">

                                                <div class="right">
                                                    {{-- <input type="button" value="Back" class="btn-step"> --}}
                                                    <a class="btn-step" href="{{ url('/payment') }}">Back</a>
                                                    <input type="submit" value="Place Order" class="btn-step btn-highligh">
                                                    {{-- <a class="btn-step btn-highligh" href="{{ url('payment') }}">Place Holder</a> --}}
                                                </div>
                                            </td>
                                        </tfoot>
                                    </table>
                                </li>
                                <li class="col-md-3">
                                    <ul class="step-list-info">
                                        @foreach ($billing as $data)
                                            <li>
                                                <div class="title-step">Billing Address</div>
                                                <p><strong>{{ $data->name }}</strong><br>
                                                    {{ $data->email }}<br>
                                                    {{ $data->address }}, {{ $data->city }}, {{ $data->state }}
                                                </p>
                                            </li>
                                        @endforeach
                                        @foreach ($shipping as $data1)
                                            <li>
                                                <div class="title-step">Shipping Address</div>
                                                <p><strong>{{ $data1->name }}</strong><br>
                                                    {{ $data1->email }}<br>
                                                    {{ $data1->address }}, {{ $data1->city }}, {{ $data1->state }}
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <div class="title-step right" style="font-size: 14px;">Payment Method:   Cash On Delivery</div>
                                </li>
                            </ul>

                        </form>

                        <div class="line-bottom"></div>
                    </div>
                    <!--- .container-->
                </div>
                <!--- .woocommerce-->
            </div>
            <!--- .main-container -->
        </div>
        <!--- .page -->
    </div>
    <!--- .wrapper -->
@endsection
