@extends('frontend.front-master')
@section('frontcontent')
    <div class="main-container col2-left-layout ">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"><a href="{{ route('frontend.home') }}" title="Go to Home Page">Home</a></li>
                    <li class="category4"><a href="{{ route('frontend.slider') }}"
                            title="Go to product Page">HEADPHONES</a></li>
                    <li class="category4"><a title="Go to Home Page"><strong>{{ $products->name }}</strong></a></li>
                </ul>
            </div>
        </div>
        <!--- .breadcrumbs-->
        <div class="container">
            <div class="main product_data">
                <div class="row">
                    <div class="col-main col-lg-12">
                        <div class="product-view">
                            <div class="product-essential">
                                <div class="row">
                                    <form action="#" method="post" id="product_addtocart_form">
                                        <div class="product-img-box clearfix col-md-5 col-sm-5 col-xs-12">
                                            <div class="product-img-content">
                                                <div class="product-image product-image-zoom">
                                                    <div class="product-image-gallery"><span
                                                            class="sticker top-left"></span>
                                                        <img id="image-main" class="gallery-image visible img-responsive"
                                                            src="{{ url('uploads/products/' . $products->image) }}"
                                                            alt="{{ $products->name }}" title="{{ $products->name }}"
                                                            style="height: 350px" />
                                                    </div>
                                                </div>
                                                <!--- .product-image-->
                                                <div class="more-views">
                                                    <h2>More View</h2>
                                                    <ul class="product-image-thumbs">
                                                        <li>
                                                            <a class="thumb-link" href="#" title=""
                                                                data-image-index="0">
                                                                <img class="img-responsive sub_img"
                                                                    src="{{ url('uploads/products/' . $products->image) }}"
                                                                    style="height: 90px" alt="img" />
                                                            </a>
                                                        </li>
                                                        @foreach ($images as $image)
                                                            <li>
                                                                <a class="thumb-link" href="#" title=""
                                                                    data-image-index="">
                                                                    <img class="img-responsive sub_img"
                                                                        src="{{ url('uploads/products/' . $image->image) }}"
                                                                        style="height: 90px" alt="img" />
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!--- .more-views -->
                                            </div>
                                            <!--- .product-img-content-->
                                        </div>
                                        <!--- .product-img-box-->
                                        <div class="product-shop col-md-7 col-sm-7 col-xs-12">
                                            <div class="product-shop-content">
                                                <div class="product-name">
                                                    <h1><b>{{ $products->name }}</b></h1>
                                                </div>
                                                <div class="product-type-data">
                                                    <div class="price-box">
                                                        <p><span class="price-label">Regular
                                                                Price:</span> <span class="price">
                                                                ₹{{ $products->price }} </span></p>
                                                    </div>
                                                    @if ($products->stock < 1)
                                                                <p class="availability in-stock ">Availability: <span
                                                                        style="color: red">Out Of Stock
                                                                    </span>
                                                                </p>
                                                            @elseif ($products->stock <= 5)
                                                                <p class="availability in-stock ">Availability: <span
                                                                        style="color: red"><b>Hurry up! only
                                                                        {{ $products->stock }} left!</b>
                                                                    </span>
                                                                </p>
                                                            @else
                                                                <p class="availability in-stock ">Availability: <span>In
                                                                        stock</span>
                                                                </p>
                                                            @endif
                                                    <div class="products-sku"><span class="text-sku">Product
                                                            Code:{{ $products->upc }}</span>
                                                    </div>
                                                </div>
                                                <div class="short-description">
                                                    <h2>Short Description</h2>
                                                    <p>Category:{{ $products->category->name }}</p>
                                                    <p>Color:{{ $products->colour->name }}</p>
                                                </div>
                                                <div class="add-to-box">
                                                    @if($products->stock >0)
                                                    <div class="product-qty">
                                                        <input type="hidden"
                                                            class="prod_id" value="{{ $products->id }}">
                                                        <label for="qty">Qty:</label>
                                                        <div class="custom-qty"> <input type="text" name="qty" id="qty"
                                                                maxlength="12" value="1" title="Qty"
                                                                class="input-text qty" />
                                                                <button type="button" class="increase items changeqty"
                                                                onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )&& qty < {{ $products->stock }}&& qty < 5) result.value++;return false;">
                                                                <i class="fa fa-plus"></i> </button>
                                                                <button type="button" class="reduced items changeqty"
                                                                onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) && qty > 1 ) result.value--;return false;">
                                                                <i class="fa fa-minus"></i> </button></div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button type="button" title="Add to Cart"
                                                            class="button addtocart btn-cart">
                                                            <span>
                                                                <span class="view-cart icon-handbag icons">
                                                                    <a href="#" style="color: white;">Add to Cart</a></span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    @else
                                                    <h1 style="color: red">OUT OF STOCK </h1>
                                                    @endif
                                                    </div>
                                                    @if (isset($products->discription))
                                                        <div class="product-wapper-tab clearfix">
                                                            <ul class="toggle-tabs">
                                                                <li class="item active" target=".box-description">
                                                                    Description</li>
                                                            </ul>
                                                            <div class="product-collateral">
                                                                <div class="box-collateral box-description active">
                                                                    <h2>Description</h2>
                                                                    <h2>Details</h2>
                                                                    <div class="std">
                                                                        <p>{{ $products->discription }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--- .product-wapper-tab-->
                                                    @endif
                                                </div>
                                                <div class="addit">
                                                    <div class="alo-social-links clearfix">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- .product-shop-content-->
                                        </div>
                                        <!--- .product-shop-->
                                    </form>
                                </div>
                            </div>
                            <!--- .product-essential-->
                        </div>
                        <!--- .product-view-->
                    </div>
                    <!--- .col-main-->
                </div>
                <!--- .row-->
            </div>
            <!--- .main-->
        </div>
        <!--- .container-->
    </div>
    <!--- .main-container -->
@endsection
@push('front-script')
    <script type="text/javascript" src="{{ asset('resources/assets/front/scripts/jquery-3.4.1.min.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.addtocart').click(function(e) {
            e.preventDefault();

            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var qty = $(this).closest('.product_data').find('.qty').val();

            // alert(product_id);
            // alert(qty);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/addtocart",
                data: {
                    'product_id': product_id,
                    'qty': qty,
                },
                success: function(response) {
                    swal(response.status)
                    if(response.minicart){
                        jQuery('.mini-contenctart').html(response.minicart);
                    }
                }
            });
        });

        $(function() {
            jQuery('.thumb-link')
                .hover(function() {
                    jQuery('#image-main').attr('src', jQuery(this).children('.sub_img').attr('src'));
                });

        });


    </script>
@endpush
