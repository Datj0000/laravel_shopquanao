<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $meta_title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="keywords" content="{{ $meta_keywords }}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="canonical" href="{{ $url_canonical }}" />
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/images/icons/favicon.png') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/main.css') }}">
    <script src="{{ asset('public/frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

</head>

<body class="animsition">
    <header class="header-v2">
        <div class="container-menu-desktop trans-03">
            <div class="wrap-menu-desktop how-shadow1">
                <nav class="limiter-menu-desktop p-l-45">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('public/frontend/images/icons/logo-01.png') }}" alt="IMG-LOGO">
                    </a>
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="{{ URL::to('/trang-chu') }}">Trang chủ</a>
                            </li>

                            <li>
                                <a href="{{ URL::to('/san-pham') }}">Sản phẩm</a>
                            </li>

                            <li>
                                <a href="{{ URL::to('/bai-viet') }}">Bài viết</a>
                            </li>

                            <li>
                                <a href="{{ URL::to('/gioi-thieu') }}">Giới thiệu</a>
                            </li>

                            <li>
                                <a href="{{ URL::to('/lien-he') }}">Liên hệ</a>
                            </li>
                        </ul>
                    </div>

                    <div class="wrap-icon-header flex-w flex-r-m h-full">
                        <div class="flex-c-m h-full p-r-24">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                                <i class="zmdi zmdi-search"></i>
                            </div>
                        </div>

                        <div class="flex-c-m h-full p-l-18 p-r-25">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart"
                                data-notify="">
                                <input style="
                                font-family: Poppins-Regular;
                                font-size: 12px;
                                color: #fff;
                                line-height: 15px;
                                text-align: center;
                                display: block;
                                position: absolute;
                                top: -7px;
                                right: 0;
                                width: 15px;
                                height: 15px;
                                padding: 0 3px;
                                background-color: #717fe0;" type="text" id="count">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>

                        <div class="flex-c-m h-full p-lr-19">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                <i class="zmdi zmdi-account"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="wrap-header-mobile">
            <div class="logo-mobile">
                <a href="{{ url('/') }}"><img src="{{ asset('public/frontend/images/icons/logo-01.png') }}"
                        alt="IMG-LOGO"></a>
            </div>

            <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                <div class="flex-c-m h-full p-r-10">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                </div>

                <div class="flex-c-m h-full p-lr-10">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart"
                        data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
                <div class="flex-c-m h-full p-lr-10">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                        <i class="zmdi zmdi-account"></i>
                    </div>
                </div>
            </div>
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li>
                    <a href="{{ URL::to('/trang-chu') }}">Trang chủ</a>
                </li>

                <li>
                    <a href="{{ URL::to('/san-pham') }}">Sản phẩm</a>
                </li>

                <li>
                    <a href="{{ URL::to('/bai-viet') }}">Bài viết</a>
                </li>

                <li>
                    <a href="{{ URL::to('/gioi-thieu') }}">Giới thiệu</a>
                </li>

                <li>
                    <a href="{{ URL::to('/lien-he') }}">Liên hệ</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="{{ asset('public/frontend/images/icons/icon-close2.png') }}" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
    <div class="wrap-sidebar js-sidebar">
        <div class="s-full js-hide-sidebar"></div>

        <div class="sidebar flex-col-l p-t-22 p-b-25">
            <div class="flex-r w-full p-b-30 p-r-27">
                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
                <ul class="sidebar-link w-full">
                    <?php
                    $customer_id = Session::get('customer_id');
                    if($customer_id){
                    ?>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/login') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Xin chào {{ Session::get('customer_name') }}
                        </a>
                    </li>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/login') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Thông tin tài khoản
                        </a>
                    </li>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/login') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Đơn hàng
                        </a>
                    </li>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/wishlist') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Yêu thích
                        </a>
                    </li>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/wishlist') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Sản phẩm đã xem
                        </a>
                    </li>
                    <li class="p-b-13">
                        <span style="cursor: pointer" id="logout" class="stext-102 cl2 hov-cl1 trans-04">
                            Đăng xuất
                        </span>
                    </li>
                    <?php
                    }else {
                    ?>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/login') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Đăng nhập
                        </a>
                    </li>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/wishlist') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Yêu thích
                        </a>
                    </li>
                    <li class="p-b-13">
                        <a href="{{ URL::to('/wishlist') }}" class="stext-102 cl2 hov-cl1 trans-04">
                            Sản phẩm đã xem
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>

                <div class="sidebar-gallery w-full p-tb-30">
                    <span class="mtext-101 cl5">
                        @ CozaStore
                    </span>

                    <div class="flex-w flex-sb p-t-36 gallery-lb">
                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-01.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-01.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-02.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-02.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-03.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-03.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-04.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-04.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-05.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-05.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-06.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-06.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-07.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-07.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-08.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-08.jpg') }});"></a>
                        </div>

                        <div class="wrap-item-gallery m-b-10">
                            <a class="item-gallery bg-img1"
                                href="{{ asset('public/frontend/images/gallery-09.jpg') }}" data-lightbox="gallery"
                                style="background-image: url({{ asset('public/frontend/images/gallery-09.jpg') }});"></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-gallery w-full">
                    <span class="mtext-101 cl5">
                        About Us
                    </span>

                    <p class="stext-108 cl6 p-t-27">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus vulputate hendrerit.
                        Praesent faucibus erat vitae rutrum gravida. Vestibulum tempus mi enim, in molestie sem
                        fermentum quis.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>
            <div class="header-cart-content flex-w js-pscroll" id="load_subcart"></div>
        </div>
    </div>
    @yield('content')

    <script src="{{ asset('public/frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/slick-custom.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <script src="{{ asset('public/frontend/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(document).on('click', '.gallery-lb', function(e) {
            e.preventDefault();
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <script src="{{ asset('public/frontend/vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/frontend/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('public/frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script>
        function down(id) {
            var numProduct = Number($('.product_quantity_' + id).val());
            if (numProduct > 1) $('.product_quantity_' + id).val(numProduct - 1);
        }

        function up(id) {
            var numProduct = Number($('.product_quantity_' + id).val());
            $('.product_quantity_' + id).val(numProduct + 1);
            var max_product_quantity = $('#qty_' + id).val();
            if (numProduct >= max_product_quantity) {
                var numProduct = Number(max_product_quantity);
                $('.product_quantity_' + id).val(max_product_quantity);
                swal({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                    button: false,
                    timer: 1500
                });
            }
        }

        function change(id) {
            var max_product_quantity = $('#qty_' + id).val();
            var numProduct = Number($('.product_quantity_' + id).val());
            if (numProduct < 1) {
                Number($('.product_quantity_' + id).val(1));
            }
            if (numProduct > max_product_quantity) {
                Number($('.product_quantity_' + id).val(max_product_quantity));
                swal({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                    button: false,
                    timer: 1500
                });
            }
        };

        function quickview(id) {
            var product_id = id;
            $.ajax({
                url: '{{ url('/xem-nhanh/') }}' + '/' + product_id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                success: function(response) {
                    $('#load_quickview').html(response);
                    $('.js-modal1').addClass('show-modal1');
                    $(".js-select2").each(function() {
                        $(this).select2({
                            minimumResultsForSearch: 20,
                            dropdownParent: $(this).next('.dropDownSelect2')
                        });
                    });
                    $('.wrap-slick3').each(function() {
                        $(this).find('.slick3').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            fade: true,
                            infinite: true,
                            autoplay: false,
                            autoplaySpeed: 6000,

                            arrows: true,
                            appendArrows: $(this).find('.wrap-slick3-arrows'),
                            prevArrow: '<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                            nextArrow: '<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                            dots: true,
                            appendDots: $(this).find('.wrap-slick3-dots'),
                            dotsClass: 'slick3-dots',
                            customPaging: function(slick, index) {
                                var portrait = $(slick.$slides[index]).data(
                                    'thumb');
                                return '<img src=" ' + portrait +
                                    ' "/><div class="slick3-dot-overlay"></div>';
                            },
                        });
                    });
                }
            })
        };

        function removeURLParameter(url, parameter) {
            var urlparts = url.split('?');
            if (urlparts.length >= 2) {

                var prefix = encodeURIComponent(parameter) + '=';
                var pars = urlparts[1].split(/[&;]/g);

                for (var i = pars.length; i-- > 0;) {
                    if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                        pars.splice(i, 1);
                    }
                }

                url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
                return url;
            } else {
                return url;
            }
        }

        function insertParam(key, value) {
            if (history.pushState) {
                var currentUrlWithOutHash = window.location.origin + window.location.pathname + window.location
                    .search;
                var hash = window.location.hash
                var currentUrlWithOutHash = removeURLParameter(currentUrlWithOutHash, key);
                var queryStart;
                if (currentUrlWithOutHash.indexOf('?') !== -1) {
                    queryStart = '&';
                } else {
                    queryStart = '?';
                }
                var newurl = currentUrlWithOutHash + queryStart + key + '=' + value + hash
                window.history.pushState({
                    path: newurl
                }, '', newurl);
                location.reload();
            }
        }
        $('.filterForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $('#keywords').val();
            insertParam('search', formData);
        })
        load_subcart();

        function load_subcart() {
            $.ajax({
                url: '{{ url('/load-subcart') }}',
                method: 'GET',
                success: function(response) {
                    $('#load_subcart').html(response);
                    var cart_count = $('#subcart_count').val();
                    $('#count').val(cart_count);
                }
            })
        };
        $(document).ready(function() {

            $(".js-select2").each(function() {
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            });
            $(document).on('click', '#logout', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('/logout') }}',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                        check_login();
                    }
                })
            });
            $(document).on('click', '.delete_cart', function(e) {
                e.preventDefault();
                var session_id = $(this).data('session_id');
                $.ajax({
                    url: '{{ url('/delete-cart/') }}' + '/' + session_id,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    success: function(response) {
                        if (response == 1) {
                            load_subcart();
                            load_cart();
                        }
                    }
                })
            });
            $('.js-addwish-b2').on('click', function(e) {
                e.preventDefault();
            });

            $('.js-addwish-b2').each(function() {
                var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
                $(this).on('click', function() {
                    swal(nameProduct, "is added to wishlist !", "success");

                    $(this).addClass('js-addedwish-b2');
                    $(this).off('click');
                });
            });

            $('.js-addwish-detail').each(function() {
                var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

                $(this).on('click', function() {
                    swal(nameProduct, "is added to wishlist !", "success");

                    $(this).addClass('js-addedwish-detail');
                    $(this).off('click');
                });
            });

            $(document).on('click', '.js-addcart-detail', function(e) {
                e.preventDefault();
                var id = $(this).data('product_id');
                var product_name = $('.product_name_' + id).val();
                var product_price = $('.product_price_' + id).val();
                var product_image = $('.product_image_' + id).val();
                var product_quantity = $('.product_quantity_' + id).val();
                var product_color = $('.product_color_' + id).val();
                var product_size = $('.product_size_' + id).val();
                if (product_color == "" || product_size == "") {
                    swal("", "Vui lòng chọn màu sắc và size của sản phẩm!", "error");
                } else {
                    $.ajax({
                        url: '{{ url('/add-cart') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            product_id: id,
                            product_name: product_name,
                            product_price: product_price,
                            product_image: product_image,
                            product_quantity: product_quantity,
                            product_color: product_color,
                            product_size: product_size
                        },
                        success: function(response) {
                            if (response == 1) {
                                swal({
                                        title: "Thành công",
                                        text: "Đến giỏ hàng của bạn!",
                                        icon: "success",
                                        buttons: {
                                            confirm: "Đồng ý",
                                            cancel: "Xem tiếp",
                                        }

                                    })
                                    .then((value) => {
                                        if (value) {
                                            window.location = "{{ url('/gio-hang') }}";
                                        }
                                    });
                                load_subcart();
                            } else if (response == 0) {
                                swal(product_name, "Sản phẩm đã có trong giỏ hàng!", "error");
                            }
                        }
                    })
                }
            });
            $(document).on('click', '.js-addcart-detail-2', function(e) {
                e.preventDefault();
                var product_id = $('#product_id').val();
                var product_name = $('#product_name').val();
                var product_price = $('#product_price').val();
                var product_image = $('#product_image').val();
                var product_quantity = $('#product_quantity').val();
                var product_color = $('#product_color').val();
                var product_size = $('#product_size').val();
                if (product_color == "" || product_size == "") {
                    swal("", "Vui lòng chọn màu sắc và size của sản phẩm!", "error");
                } else {
                    $.ajax({
                        url: '{{ url('add-cart') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            product_id: product_id,
                            product_name: product_name,
                            product_price: product_price,
                            product_image: product_image,
                            product_quantity: product_quantity,
                            product_color: product_color,
                            product_size: product_size
                        },
                        success: function(response) {
                            if (response == 1) {
                                swal(product_name, "Thêm sản phẩm thành công!", "success");
                                load_subcart();
                            } else if (response == 0) {
                                swal(product_name, "Sản phẩm đã có trong giỏ hàng!", "error");
                            }
                        }
                    })
                }
            });
        });
    </script>
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Categories
                    </h4>

                    <ul>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Women
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Men
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Shoes
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Watches
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Help
                    </h4>

                    <ul>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Track Order
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Returns
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Shipping
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                FAQs
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        GET IN TOUCH
                    </h4>

                    <p class="stext-107 cl7 size-201">
                        Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us
                        on (+1) 96 716 6879
                    </p>

                    <div class="p-t-27">
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Newsletter
                    </h4>

                    <form>
                        <div class="wrap-input1 w-full p-b-4">
                            <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                                placeholder="email@example.com">
                            <div class="focus-input1 trans-04"></div>
                        </div>

                        <div class="p-t-18">
                            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-t-40">
                <div class="flex-c-m flex-w p-b-18">
                    <a href="#" class="m-all-1">
                        <img src="{{ asset('public/frontend/images/icons/icon-pay-01.png') }}" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="{{ asset('public/frontend/images/icons/icon-pay-02.png') }}" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="{{ asset('public/frontend/images/icons/icon-pay-03.png') }}" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="{{ asset('public/frontend/images/icons/icon-pay-04.png') }}" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="{{ asset('public/frontend/images/icons/icon-pay-05.png') }}" alt="ICON-PAY">
                    </a>
                </div>

                <p class="stext-107 cl6 txt-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </p>
            </div>
        </div>
    </footer>
</body>

</html>
