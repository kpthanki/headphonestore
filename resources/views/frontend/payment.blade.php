@extends('frontend.front-master')
@section('frontcontent')
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
                    <h2>Payment</h2>
                </div>
                <div class="checkout-step-process">
                    <ul>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step2.html"
                                    class="redirectjs fa fa-check step-icon"></i><span class="text">Address</span>
                            </div>
                        </li>
                        <li>
                            <div class="step-process-item"><i class="fa fa-check step-icon"></i><span
                                    class="text">Shipping</span></div>
                        </li>
                        <li>
                            <div class="step-process-item active"><i data-href="checkout-step4.html"
                                    class="redirectjs step-icon icon-wallet"></i><span class="text">Delivery &
                                    Payment</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step5.html"
                                    class="redirectjs step-icon icon-notebook"></i><span class="text">Order
                                    Review</span></div>
                        </li>
                    </ul>
                </div>

                <div class="checkout-info-text">
                    <h3>Delivery</h3>
                </div>
                <div class="content-radio">
                    <input type="radio" checked name="delivery-radio" id="delivery-radio-1">
                    <label for="delivery-radio-1" class="label-radio">Standard Delivery</label>
                    <form action="" class="form-in-checkout">
                        <ul class="row">
                            <li class="col-md-9">
                                <ul class="row">
                                    <li class="col-md-6">
                                        <p class="form-row validate-required">
                                            <label for="delivery_first_name" class="">Name <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="delivery_first_name"
                                                id="delivery_first_name" value="{{ Auth::user()->name }}">
                                        </p>
                                    </li>
                                    <li class="col-md-6">
                                        <p class="form-row validate-required">
                                            <label for="delivery_last_name" class="">Email <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text" name="delivery_last_name"
                                                id="delivery_last_name" value="{{ Auth::user()->email }}">
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="checkout-info-text">
                    <h3>Payment Method</h3>
                </div>
                <div class="content-radio">
                    <input type="radio" name="payment-radio" checked id="pr1">
                    <label for="pr1" class="label-radio">At home</label>
                    <p>Pay for the package when you recieve it.</p>
                </div>
                <div class="checkout-col-footer">
                    <a href="/shipping" class="btn-step">Back</a>
                    <a href="/order" class="btn-step btn-highligh">Continue</a>
                </div>
                <div class="line-bottom"></div>
            </div>
        </div>
        <!--- .woocommerce-->
@endsection
