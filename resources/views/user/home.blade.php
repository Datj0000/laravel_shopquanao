@extends('userlayout')
@section('content')
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1"
                    style="background-image: url({{ asset('public/frontend/images/slide-01.jpg') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Women Collection 2018
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    NEW SEASON
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="product.html"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick1"
                    style="background-image: url({{ asset('public/frontend/images/slide-02.jpg') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Men New-Season
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    Jackets & Coats
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                <a href="product.html"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick1"
                    style="background-image: url({{ asset('public/frontend/images/slide-03.jpg') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Men Collection 2018
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    New arrivals
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                <a href="product.html"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ asset('public/frontend/images/banner-01.jpg') }}" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Women
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Spring 2018
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ asset('public/frontend/images/banner-02.jpg') }}" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Men
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Spring 2018
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ asset('public/frontend/images/banner-03.jpg') }}" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Accessories
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    New Trend
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="bg0 p-t-23 p-b-66">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button id="product_new" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1">
                        Sản phẩm mới
                    </button>

                    <button id="product_old" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                        Sản phẩm cũ
                    </button>
                    <button id="product_top" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                        Sản phẩm nổi bật
                    </button>

                    <button id="product_sold" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                        Sản phẩm bán chạy
                    </button>
                </div>
            </div>
            <div class="row" id="load_product"></div>
        </div>
    </section>
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-103 cl5">
                    Blog Overview
                </h3>
            </div>

            <div class="row" id="load_blog">

            </div>
        </div>
    </section>
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>
        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('public/frontend/images/icons/icon-close.png') }}" alt="CLOSE">
                </button>
                <div id="load_quickview" class="row"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            load_product();
            load_blog();

            function load_product() {
                $.ajax({
                    url: 'load-product-new',
                    method: 'GET',
                    success: function(response) {
                        $('#load_product').html(response);
                    }
                })
            };
            function load_blog() {
                $.ajax({
                    url: 'load-blog',
                    method: 'GET',
                    success: function(response) {
                        $('#load_blog').html(response);
                    }
                })
            };
            $(document).on('click', '#product_new', function(e) {
                load_product();
            });
            $(document).on('click', '#product_old', function(e) {
                $.ajax({
                    url: 'load-product-old',
                    method: 'GET',
                    success: function(response) {
                        $('#load_product').html(response);
                    }
                })
            });
            $(document).on('click', '#product_top', function(e) {
                $.ajax({
                    url: 'load-product-top',
                    method: 'GET',
                    success: function(response) {
                        $('#load_product').html(response);
                    }
                })
            });
            $(document).on('click', '#product_sold', function(e) {
                $.ajax({
                    url: 'load-product-sold',
                    method: 'GET',
                    success: function(response) {
                        $('#load_product').html(response);
                    }
                })
            });
        });
    </script>
@endsection
