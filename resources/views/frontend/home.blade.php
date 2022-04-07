<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="template-default template-all">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>HEADPHONES STORE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" media="all" />
</head>

<body>
    @include('frontend.header')

    <div class="main-container col1-layout content-color color">
        <div class="alo-block-slide">
            <div class="container-none flex-index">
                <div class="flexslider">
                    <div id="slider-index" class="slides">
                        <div class="item">
                            <a href="{{ route('frontend.slider') }}"><img src="assets/images/image1.jpg"
                                    alt="magicslider"></a>
                            <div class="bx-caption start play">
                                <div class="container">
                                    <div class="text-slide">
                                        <h3 class="caption1">Sale</h3>
                                        <h3 class="caption2">Extra<strong>30%</strong>off</h3>
                                        <h2 class="caption3">When you buy from 2 or more...</h2>
                                        <p class="icon-anchor icons caption6"><span class="hidden">hidden</span>
                                        </p>
                                        <a href="{{ route('frontend.slider') }}" class="btn-shop caption4">Shop
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a href="{{ route('frontend.slider') }}"><img src="assets/images/image2.jpg"
                                    alt="magicslider"></a>
                            <div class="bx-caption ">
                                <div class="container">
                                    <div class="text-slide text-slide2">
                                        <h3 class="caption1">Devloper’s</h3>
                                        <h3 class="caption2">looks</h3>
                                        <h2 class="caption3">Summer</h2>
                                        <h2 class="caption5">2022</h2>
                                        <h3 class="caption4"><a href="{{ route('frontend.slider') }}"
                                                class="btn-shop">Shop Now</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a href="{{ route('frontend.slider') }}"> <img src="assets/images/image3.jpeg"
                                    alt="magicslider"> </a>
                            <div class="bx-caption ">
                                <div class="container">
                                    <div class="text-slide text-slide3">
                                        <h3 class="caption1">Mid-Season</h3>
                                        <h3 class="caption2">Must have for Student 2022</h3>
                                        <h3 class="caption4"><a href="{{ route('frontend.slider') }}"
                                                class="btn-shop">Shop Now</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- #slider-indexs-->
                </div>
            </div>
        </div>
        <!--- .alo-block-slide-->

        @include('frontend.footer')
        <script type="text/javascript" src="assets/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.noconflict.js"></script>
        <script type="text/javascript" src="assets/scripts/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.bxslider.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.ddslick.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.easing.min.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.meanmenu.hack.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.animateNumber.min.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery.heapbox-0.9.4.min.js"></script>
        <script type="text/javascript" src="assets/scripts/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="assets/scripts/packery-mode.pkgd.min.js"></script>
        <script type="text/javascript" src="assets/scripts/video.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/scripts/magiccart/magicproduct.js"></script>
        <script type="text/javascript" src="assets/scripts/magiccart/magicaccordion.js"></script>
        <script type="text/javascript" src="assets/scripts/magiccart/magicmenu.js"></script>
        <script type="text/javascript" src="assets/scripts/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        @stack('front-script')
</body>

</html>
