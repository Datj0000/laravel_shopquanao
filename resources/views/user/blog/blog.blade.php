@extends('userlayout')
@section('content')
    <style>
        #active {
            color: #717fe0;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/sub.css') }}">
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/frontend/images/bg-02.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Bài viết
        </h2>
    </section>
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        @foreach ($blog as $item)
                            <div class="p-b-63">
                                <a href="{{ URL::to('/chi-tiet-bai-viet/' . $item->blog_slug) }}"
                                    class="hov-img0 how-pos5-parent">
                                    <div style="height: 450px">
                                        <img src="{{ URL::to('public/uploads/blog/' . $item->blog_image) }}"
                                            alt="IMG-BLOG">
                                    </div>
                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
                                        <span class="ltext-107 cl2 txt-center">
                                            {{ \Carbon\Carbon::parse($item->blog_date)->format('d') }}
                                        </span>

                                        <span class="stext-109 cl3 txt-center">
                                            {{ \Carbon\Carbon::parse($item->blog_date)->format('m/Y') }}
                                        </span>
                                    </div>
                                </a>

                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="{{ URL::to('/chi-tiet-bai-viet/' . $item->blog_slug) }}"
                                            class="ltext-108 cl2 hov-cl1 trans-04">
                                            {{ $item->blog_name }}
                                        </a>
                                    </h4>

                                    <p class="stext-117 cl6">
                                        {!! \Illuminate\Support\Str::limit($item->blog_desc, 150, $end = '...') !!}
                                    </p>

                                    <div class="flex-w flex-sb-m p-t-18">
                                        <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                                            <span>
                                                Lượt xem {{ $item->blog_views }}
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>
                                            <span>
                                                @php
                                                    $comment = \App\Models\CommentBlog::where('comment_blog_id', $item->blog_id)->get();
                                                    $count_comment = $comment->count();
                                                @endphp
                                                Bình luận {{ $count_comment }}
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>
                                            <span>
                                                Ngày đăng {{ \Carbon\Carbon::parse($item->blog_date)->format('d/m/Y') }}
                                            </span>
                                        </span>

                                        <a href="blog-detail.html" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                            Xem tiếp

                                            <i class="fa fa-long-arrow-right m-l-9"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- Pagination -->
                        <div class="flex-c-m flex-w w-full p-t-38">
                            {!! $blog->links() !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="shop__sidebar__search">
                            <form class="filterForm" autocomplete="off">
                                <input id="keywords" name="search" type="text" placeholder="Tìm kiếm"
                                    value="{{ Request::get('search') }}">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                <div id="search"></div>
                            </form>
                        </div>
                        <div class="p-t-10">
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
                                Featured Products
                            </h4>

                            <ul>
                                @foreach ($product_top as $item)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $item->product_id) }}"
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
        $('#keywords').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "{{ url('/autocomplete-blog') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        query: query
                    },
                    success: function(data) {
                        console.log(data);
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
