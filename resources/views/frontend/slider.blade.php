@extends('frontend.front-master')
@section('frontcontent')
    <div class="main-container col2-left-layout ">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="{{ route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="category4"><strong>Headphones</strong></li>
                </ul>
            </div>
        </div>
        <!--- .breadcrumbs-->
        <div class="container">
            <div class="main">
                <div class="row filter">
                    <div class="col-left sidebar col-lg-3 col-md-3 col-sm-3 left-color color">
                        <div class="anav-container">
                        </div>
                        <!--- .anav-container-->
                        <div class="block block-layered-nav block-layered-nav--no-filters">
                            <div class="block-title"> <strong><span>Shop By</span></strong></div>
                            <div class="block-content toggle-content">
                                <p class="block-subtitle block-subtitle--filter">Filter</p>
                                <dl id="narrow-by-list">
                                    <dt class="even">By Price</dt>
                                    <dd class="even">
                                        <div class="slider-ui-wrap">
                                            <div id="price-range" class="slider-ui" slider-min="100" slider-max="5000"
                                                slider-min-start="0" slider-max-start="5000"></div>
                                        </div>
                                        <form action="" method="" class="price-range-form">
                                            <input type="text" class="range_value range_value_min" target="#price-range" />
                                            - <input type="text" class="range_value range_value_max"
                                                target="#price-range" />
                                            <input type="submit" class="btn-submit" value="OK" />
                                        </form>
                                    </dd>
                                    <dt class="odd">By Brands</dt>
                                    <dd class="odd">
                                        <ul style="" class="nav-accordion">
                                            @foreach ($category as $cat)
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="{{ $cat->id }}"
                                                            name="category_check" id="category_check"
                                                            class="category_check">
                                                        <span class="count">{{ $cat->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                    <dt class="even">By Colors</dt>
                                    <dd class="even">
                                        <ol class="configurable-swatch-list color_list">
                                            @foreach ($colour as $color)
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="{{ $color->id }}"
                                                            name="color_check" id="color_check" class="color_check">
                                                        <span class="count">{{ $color->name }}</span>
                                                    </label>
                                                    {{-- </a> --}}
                                                </li>
                                            @endforeach
                                        </ol>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <!--- .block-layered-nav-->
                    </div>
                    <!--- .sidebar-->
                    <div class="col-main col-lg-9 col-md-9 col-sm-9 col-xs-12 content-color color">
                        <div class="page-title category-title">
                            <h1>HEADPHONES</h1>
                        </div>
                        <p class="category-image"><img src="" alt="HEADPHONES" title="HEADPHONES"></p>
                        <div class="category-products">
                            <div class="toolbar">
                                <div class="sorter">
                                    <p class="view-mode">
                                        <label>View as:</label>
                                        <a href="javascript:void(0)" title="Grid" id="grid" class="redirectjs grid viewas">
                                            <i class="icon-grid icons"></i>
                                        </a>
                                        <a href="javascript:void(0)" title="List" id="list" class="list viewas active">
                                            <i class="icon-list icons"></i>
                                        </a>
                                    </p>
                                    <div class="sort-by">
                                        <label>Sort By</label>
                                        <select class="name_price">
                                            <option value="name" selected> Name</option>
                                            <option value="price"> Price</option>
                                        </select>
                                        <select class="asc_desc">
                                            <option value="asc" selected> Ascending</option>
                                            <option value="desc"> Descending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="content">
                            </div>
                        </div>
                    @endsection
                    @push('front-script')
                        <script type="text/javascript">
                            jQuery('#grid').click(function() {
                                jQuery(this).addClass('active');
                                jQuery('#list').removeClass('active');
                            });
                            jQuery('#list').click(function() {
                                jQuery(this).addClass('active');
                                jQuery('#grid').removeClass('active');
                            });
                            jQuery('.price-range-form').on('input', '.range_value_min,.range_value_max', function() {
                                if (jQuery('.range_value_min').val() == '') {
                                    jQuery('.range_value_min').val(0);
                                }
                                if (jQuery('.range_value_max').val() == '') {
                                    jQuery('.range_value_max').val(1);
                                }
                            });
                            jQuery('.range_value_max,.range_value_min').keypress(function(e) {
                                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                    return false;
                                }
                            });

                            function filter() {
                                var category = [];
                                jQuery.each(jQuery("input[name='category_check']:checked"), function() {
                                    category.push(jQuery(this).val());
                                });
                                var color = [];
                                jQuery.each(jQuery("input[name='color_check']:checked"), function() {
                                    color.push(jQuery(this).val());
                                });
                                var sort_name_price = jQuery('.name_price option:selected').val();
                                var sort_asc_desc = jQuery('.asc_desc option:selected').val();
                                jQuery.ajax({
                                    type: "get",
                                    url: "/sortProduct",
                                    data: {
                                        category: category,
                                        color: color,
                                        view: jQuery('#grid').hasClass('active'),
                                        max_price: jQuery('.range_value_max').val().match(/\d+/),
                                        min_price: jQuery('.range_value_min').val().match(/\d+/),
                                        sort_name_price: sort_name_price,
                                        sort_asc_desc: sort_asc_desc,

                                    },
                                    dataType: 'HTML',
                                    success: function(response) {
                                        jQuery('#content').html(response);
                                    },
                                });
                            }
                            jQuery(document).ready(function() {
                                filter();
                            });
                            jQuery('.filter').on('click select', "input[type='checkbox'],input[type='button'],.viewas,select,.btn-submit", function() {
                                filter();
                            });
                        </script>
                    @endpush
