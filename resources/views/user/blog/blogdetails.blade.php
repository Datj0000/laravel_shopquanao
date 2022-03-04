@extends('userlayout')
@section('content')
    <style>
        figure img {
            margin: 0 auto;
            display: block;
        }

    </style>
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ URL::to('/') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ URL::to('/bai-viet') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Bài viết
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $meta_title }}
            </span>
        </div>
    </div>
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        @foreach ($blog as $item)
                            <div class="wrap-pic-w how-pos5-parent">
                                <div style="max-height: 450px">
                                    <img src="{{ URL::to('public/uploads/blog/' . $item->blog_image) }}" alt="IMG-BLOG">
                                </div>
                                <div class="flex-col-c-m size-123 bg9 how-pos5">
                                    <span class="ltext-107 cl2 txt-center">
                                        22
                                    </span>

                                    <span class="stext-109 cl3 txt-center">
                                        Jan 2018
                                    </span>
                                </div>
                            </div>

                            <div class="p-t-32">
                                <span class="flex-w flex-m stext-111 cl2 p-b-19">
                                    <span>
                                        <span class="cl4">By</span> Admin
                                        <span class="cl12 m-l-4 m-r-6">|</span>
                                    </span>

                                    <span>
                                        22 Jan, 2018
                                        <span class="cl12 m-l-4 m-r-6">|</span>
                                    </span>

                                    <span>
                                        StreetStyle, Fashion, Couple
                                        <span class="cl12 m-l-4 m-r-6">|</span>
                                    </span>

                                    <span>
                                        8 Comments
                                    </span>
                                </span>

                                <h4 class="ltext-109 cl2 p-b-28">
                                    {{ $item->blog_name }}
                                </h4>

                                <p style="text-align: justify" class="stext-117 cl6 p-b-26">
                                    {!! $item->blog_desc !!}
                                </p>
                            </div>
                        @endforeach
                        <div class="p-t-40 p-b-68">
                            <h5 class="mtext-108 cl2 p-b-7">
                                Bình luận
                            </h5>

                            <div class="row p-b-25">
                                <input type="hidden" id="blog_id" value="{{ $item->blog_id }}">
                                <div class="col-12 p-b-5">
                                    <label class="stext-102 cl3" for="comment_name">Tên</label>
                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="comment_name" type="text"
                                        name="comment_name">
                                </div>
                                <div class="col-12 p-b-5">
                                    <label class="stext-102 cl3" for="comment_review">Nội dụng bình luận</label>
                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="comment_review"
                                        name="comment_review"></textarea>
                                </div>
                                <div class="col-12 p-b-5" id="notify_comment"></div>
                            </div>
                            <button
                                class="send-comment flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Gửi
                            </button>
                        </div>
                        <div id="comment_show"></div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="bor17 of-hidden pos-relative">
                            <form class="filterForm">
                                <input name="search" class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text"
                                    placeholder="Tìm kiếm" value="{{ Request::get('search') }}">
                                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04" type="submit"><i
                                        class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Danh mục
                            </h4>

                            <ul>
                                @foreach ($category_blog as $item)
                                    <li class="bor18">
                                        <a id="{{ Request::get('danh_muc') == $item->category_slug ? 'active' : '' }}"
                                            href="{{ request()->fullUrlWithQuery(['danh_muc' => $item->category_slug]) }}"
                                            class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                            {{ $item->category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-t-65">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Sản phẩm nổi bật
                            </h4>

                            <ul>
                                @foreach ($product_top as $item)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $item->blog_id) }}"
                                            class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                            <img width="90"
                                                src="{{ URL::to('public/uploads/product/' . $item->product_image) }}"
                                                alt="PRODUCT">
                                        </a>

                                        <div class="size-215 flex-col-t p-t-8">
                                            <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                                                {{ $item->product_name }}
                                            </a>

                                            <span class="stext-116 cl6 p-t-20">
                                                {{ number_format($item->product_price, 0, ',', '.') . ' ' . 'đ' }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        load_comment();
        function load_comment() {
            var blog_id = $('#blog_id').val();
            $.ajax({
                url: "{{ url('/load-comment-blog') }}" + '/' + blog_id,
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
            var blog_id = $('#blog_id').val();
            var comment_name = $('#comment_name').val();
            var comment_content = $('#comment_review').val();
            if (comment_content == "" || comment_name == "") {
                $('#notify_comment').html(
                    '<span class="stext-102 cl3 m-r-16 text-danger">Vui lòng điền tên và nội dung bình luận của bạn</span>'
                );
                $('#notify_comment').fadeOut(9000);
            } else {
                $.ajax({
                    url: "{{ url('/send-comment-blog') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        blog_id: blog_id,
                        comment_name: comment_name,
                        comment_content: comment_content
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
