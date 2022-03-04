@extends('userlayout')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/sub.css') }}">
    <style>
        a{
            cursor: pointer;
        }
    </style>
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form class="filterForm" autocomplete="off">
                                <input id="keywords" name="search" type="text" placeholder="Tìm kiếm"
                                    value="{{ Request::get('search') }}">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                <div id="search"></div>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample"></div>
                            <div class="card">
                                <div class="card-heading">
                                    <a href="{{ URL::to('/san-pham') }}">Tất cả sản phẩm</a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul>
                                                @foreach ($cate_product as $key => $value)
                                                    <li><a class="{{ Request::get('danh_muc') == $value->slug_category_product ? 'active' : '' }}"
                                                            onclick="insertParam('danh_muc', '{{ $value->slug_category_product }}')">{{ $value->category_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Thương hiệu</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                @foreach ($brand_product as $key => $value)
                                                    <li><a class="{{ Request::get('thuong_hieu') == $value->brand_slug ? 'active' : '' }}"
                                                            onclick="insertParam('thuong_hieu', '{{ $value->brand_slug }}')">{{ $value->brand_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Lọc giá</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a class="{{ Request::get('price') == 1 ? 'active' : '' }}"
                                                        onclick="insertParam('price', '1')">Dưới
                                                        100.000đ</a></li>
                                                <li><a class="{{ Request::get('price') == 2 ? 'active' : '' }}"
                                                        onclick="insertParam('price', '2')">100.000đ
                                                        -
                                                        200.000đ</a></li>
                                                <li><a class="{{ Request::get('price') == 3 ? 'active' : '' }}"
                                                        onclick="insertParam('price', '3')">200.000đ
                                                        -
                                                        300.000đ</a></li>
                                                <li><a class="{{ Request::get('price') == 4 ? 'active' : '' }}"
                                                        onclick="insertParam('price', '4')">300.000đ
                                                        -
                                                        400.000đ</a></li>
                                                <li><a class="{{ Request::get('price') == 5 ? 'active' : '' }}"
                                                        onclick="insertParam('price', '5')">400.000đ
                                                        - 500.000đ</a></li>
                                                <li><a class="{{ Request::get('price') == 6 ? 'active' : '' }}"
                                                        onclick="insertParam('price', '6')">Trên
                                                        500.000đ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">
                                            {{-- @php
                                                $tags = $value->product_tags;
                                                $tags = explode(",",$tags);
										    @endphp
											@foreach ($tags as $tag)
												<a href="{{url('/tag/'.str_slug($tag))}}">{{$tag}}</a>
											@endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    {{-- <p>Showing 1–12 of 126 results</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sắp xếp:</p>
                                    <select id="selectProduct">
                                        <option {{ Request::get('sort_by') == 'none' ? "selected='selected'" : '' }}
                                            value="none">Mặc định</option>
                                        <option {{ Request::get('sort_by') == 'tang_dan' ? "selected='selected'" : '' }}
                                            value="tang_dan">Giá tăng dần</option>
                                        <option {{ Request::get('sort_by') == 'giam_dan' ? "selected='selected'" : '' }}
                                            value="giam_dan">Giá giảm dần</option>
                                        <option {{ Request::get('sort_by') == 'kytu_az' ? "selected='selected'" : '' }}
                                            value="kytu_az">Lọc theo tên A đến Z</option>
                                        <option {{ Request::get('sort_by') == 'kytu_za' ? "selected='selected'" : '' }}
                                            value="kytu_za">Lọc theo tên Z đến A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="load_product">
                        @foreach ($all_product as $key => $pro)
                            <div class="col-sm-6 col-md-4 col-lg-4 p-b-35">
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src={{ URL::to('public/uploads/product/' . $pro->product_image) }}
                                            alt="IMG-PRODUCT">

                                        <span style="cursor: pointer" id="{{ $pro->product_id }}"
                                            onclick="quickview(this.id)"
                                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Xem nhanh
                                        </span>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="{{ URL::to('chi-tiet-san-pham/' . $pro->product_slug) }}"
                                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $pro->product_name }}
                                            </a>

                                            <span class="stext-105 cl3">
                                                {{ number_format($pro->product_price, 0, ',', '.') }} đ
                                            </span>
                                        </div>

                                        <div class="block2-txt-child2 flex-r p-t-3">
                                            <span style="cursor: pointer"
                                                class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                <img class="icon-heart1 dis-block trans-04"
                                                    src="public/frontend/images/icons/icon-heart-01.png" alt="ICON">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                    src="public/frontend/images/icons/icon-heart-02.png" alt="ICON">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        $('#keywords').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "{{ url('/autocomplete') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#search').fadeIn();
                        $('#search').html(data);
                    }
                });
            } else {
                $('#search').fadeOut();
            }
        });

        $(document).on('click', '.li_search', function() {
            $('#keywords').val($(this).text());
            $('#search').fadeOut();
        });
    </script>
@endsection
