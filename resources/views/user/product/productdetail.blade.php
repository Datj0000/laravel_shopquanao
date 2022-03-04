@extends('userlayout')
@section('content')
    @foreach ($product_details as $key => $value)
        <div class="container">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                <a href="{{url('/')}}" class="stext-109 cl8 hov-cl1 trans-04">
                    Trang chủ
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <a href="{{url('/san-pham')}}" class="stext-109 cl8 hov-cl1 trans-04">
                    Sản phẩm
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    {{ $value->product_name }}
                </span>
            </div>
        </div>
        <section class="sec-product-detail bg0 p-t-65 p-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick4 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3"
                                        data-thumb="{{ URL::to('public/uploads/product/' . $value->product_image) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ URL::to('public/uploads/product/' . $value->product_image) }}"
                                                alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ URL::to('public/uploads/product/' . $value->product_image) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @foreach ($gallery as $key => $gal)
                                        <div class="item-slick3"
                                            data-thumb="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}"
                                                    alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <input type="hidden" id="product_id" value="{{ $value->product_id }}">
                            <input type="hidden" id="product_name" value="{{ $value->product_name }}">
                            <input type="hidden" id="product_price" value="{{ $value->product_price }}">
                            <input type="hidden" id="product_image" value="{{ $value->product_image }}">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                {{ $value->product_name }}
                            </h4>

                            <span class="mtext-106 cl2">
                                {{ number_format($value->product_price, 0, ',', '.') }}đ
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare
                                feugiat.
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select id="product_size" class="js-select2" name="time">
                                                <option value="">Choose an option</option>
                                                <option value="S">Size S</option>
                                                <option value="M">Size M</option>
                                                <option value="L">Size L</option>
                                                <option value="XL">Size XL</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select id="product_color" class="js-select2" name="time">
                                                <option value="">Choose an option</option>
                                                <option value="red">Red</option>
                                                <option value="bule">Blue</option>
                                                <option value="white">White</option>
                                                <option value="grey">Grey</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input id="product_quantity" class="mtext-104 cl3 txt-center num-product"
                                                type="number" name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail-2">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                        class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                        data-tooltip="Add to Wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bor10 m-t-50 p-t-43 p-b-40">
                    <!-- Tab01 -->
                    <div class="tab01">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item p-b-10">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả</a>
                            </li>


                            <li class="nav-item p-b-10">
                                <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Bình luận ({{$count_comment}})</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-t-43">
                            <!-- - -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="how-pos2 p-lr-15-md">
                                    <p class="stext-102 cl6">
                                        {!! $value->product_desc !!}
                                    </p>
                                </div>
                            </div>

                            <!-- - -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                        <div class="p-b-30 m-lr-15-sm">
                                            <!-- Add review -->
                                            <div class="w-full p-b-68">
                                                <h5 class="mtext-108 cl2 p-b-7">
                                                    Thêm bình luận
                                                </h5>

                                                <div class="flex-w flex-m p-t-50 p-b-23">
                                                    <span class="stext-102 cl3 m-r-16">
                                                        Đánh giá
                                                    </span>

                                                    <span class="wrap-rating fs-18 cl11 pointer">
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <input id="comment_rating" class="dis-none" type="number"
                                                            name="rating">
                                                    </span>
                                                </div>

                                                <div class="row p-b-25">
                                                    <input type="hidden" id="comment_product_id"
                                                        value="{{ $value->product_id }}">
                                                    <div class="col-12 p-b-5">
                                                        <label class="stext-102 cl3" for="comment_name">Họ tên</label>
                                                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="comment_name"
                                                            type="text" name="comment_name">
                                                    </div>
                                                    <div class="col-12 p-b-5">
                                                        <label class="stext-102 cl3" for="comment_review">Đánh giá</label>
                                                        <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                            id="comment_review" name="comment_review"></textarea>
                                                    </div>
                                                    <div class="col-12 p-b-5" id="notify_comment"></div>
                                                </div>
                                                <button
                                                    class="send-comment flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                    Gửi
                                                </button>
                                            </div>

                                            <!-- Review -->
                                            <div id="comment_show"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
                {{-- <span class="stext-107 cl6 p-lr-25">
                    SKU: JAK-01
                </span> --}}

                <span class="stext-107 cl6 p-lr-25">
                    Danh mục: {{ $value->category_name }}
                </span>

                <span class="stext-107 cl6 p-lr-25">
                    Thương hiệu: {{ $value->brand_name }}
                </span>
            </div>
        </section>
    @endforeach
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
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Sản phẩm liên quan
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($relate as $key => $lienquan)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ URL::to('public/uploads/product/' . $lienquan->product_image) }}"
                                        alt="IMG-PRODUCT">

                                    <span style="cursor: pointer" id="{{ $lienquan->product_id }}"
                                        onclick="quickview(this.id)"
                                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        Quick View
                                    </span>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="chi-tiet-san-pham/'.$pro->product_id.'"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $lienquan->product_name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            {{ $lienquan->product_price }} VNĐ
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04"
                                                src="{{ URL::to('public/frontend/images/icons/icon-heart-01.png') }}"
                                                alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                src="{{ URL::to('public/frontend/images/icons/icon-heart-02.png') }}"
                                                alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).on('click', '.btn-num-product-down', function(e) {
            var numProduct = Number($(this).next().val());
            if (numProduct > 1) $(this).next().val(numProduct - 1);
        });
        $(document).on('click', '.btn-num-product-up', function(e) {
            var numProduct = Number($(this).prev().val());
            $(this).prev().val(numProduct + 1);
        });
        load_comment();

        function load_comment() {
            var product_id = $('#product_id').val();
            $.ajax({
                url: "{{ url('/load-comment') }}" + '/' + product_id,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                success: function(data) {
                    $('#comment_show').html(data);
                }
            });
        }
        $('.send-comment').click(function() {
            var product_id = $('#comment_product_id').val();
            var comment_name = $('#comment_name').val();
            var comment_content = $('#comment_review').val();
            var comment_rating = $('#comment_rating').val();
            if (comment_content == "" || comment_name == "") {
                $('#notify_comment').html(
                    '<span class="stext-102 cl3 m-r-16 text-danger">Vui lòng điền tên và nội dung bình luận của bạn</span>'
                );
                $('#notify_comment').fadeOut(9000);
            } else {
                $.ajax({
                    url: "{{ url('/send-comment') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        comment_rating: comment_rating
                    },
                    success: function(data) {
                        load_comment();
                        $('#notify_comment').html(
                            '<span class="stext-102 cl3 m-r-16 text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>'
                        );
                        $('#notify_comment').fadeOut(9000);
                        $('#comment_name').val('');
                        $('#comment_review').val('');
                    }
                });
            }
        });
    </script>
@endsection
