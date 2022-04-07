
<p class="block-subtitle">Recently added item(s)</p>
                                            @php $total = 0;  @endphp
                                            @foreach ($cartitems->slice(0, 3) as $item)
                                                <ol id="cart-sidebar" class="mini-products-list clearfix">
                                                    <li class="item clearfix">
                                                        <div class="cart-content-top">
                                                            <a href="{{ $item->product->name }}" title="{{ $item->product->name }}">
                                                            <img src="{{ url('uploads/products/' . $item->product->image) }}"
                                                            width="80" />
                                                            </a> &nbsp;
                                                            <button type="button" class="button-remove"  style="background-color: white;" id="" onclick="removeitem(this)" data-product_id="{{ $item->product_id }}"><i class="fa fa-close" style="color: red;"></i></button>
                                                            <div class="product-details">
                                                                <p class="product-name">
                                                                <a href="{{ $item->product->name }}" title="{{ $item->product->name }}">{{ $item->product->name }}</a>
                                                                </p>
                                                                <strong>{{$item->qty}} * </strong> <span class="price">₹{{$item->product->price*$item->qty}}/-</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                                @php
                                                    $total += $item->product->price * $item->qty;
                                                @endphp
                                            @endforeach
                                            <p class="subtotal"> <span class="label">Subtotal:</span>
                                                <span class="price">₹{{ $total }}/-</span></p>
                                                <div class="actions">
                                                    <a href="{{ route('frontend.cart') }}" class="view-cart"> View cart </a>
                                                    {{-- <a href="{{ url('/checkout') }}"> Checkout --}}
                                                     </div>
                                                </div>
