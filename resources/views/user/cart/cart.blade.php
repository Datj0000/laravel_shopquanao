@extends('userlayout')
@section('content')
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ url('/trang-chu') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Giỏ hàng
            </span>
        </div>
    </div>
    <form class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row" id="load_cart"></div>
        </div>
    </form>

    <script>
        load_cart();

        function load_cart() {
            $.ajax({
                url: 'load-cart',
                method: 'GET',
                success: function(response) {
                    $('#load_cart').html(response);
                }
            })
        }

        function update_cart(session_id, product_quantity) {
            $.ajax({
                url: 'update-cart-ajax',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                data: {
                    session_id: session_id,
                    product_quantity: product_quantity
                },
                success: function(response) {
                    load_cart();
                    load_subcart();
                }
            })
        }
        $(document).on('click', '.btn-num-product-down', function(e) {
            var session_id = $(this).data('session_id');
            var numProduct = Number($(this).next().val());
            if (numProduct > 1) $(this).next().val(numProduct - 1);
            var product_quantity = numProduct - 1;
            if (numProduct > 1) {
                var product_quantity = numProduct - 1;
            } else {
                var product_quantity = 1;
            }
            update_cart(session_id, product_quantity);
        });
        $(document).on('click', '.btn-num-product-up', function(e) {
            var session_id = $(this).data('session_id');
            var numProduct = Number($(this).prev().val());
            $(this).prev().val(numProduct + 1);
            var max_product_quantity = $('.product_quantity_' + session_id).val();
            var product_quantity = numProduct + 1;
            if (product_quantity > max_product_quantity) {
                update_cart(session_id, max_product_quantity);
                swal({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                    button: false,
                    timer: 1500
                });
            } else {
                update_cart(session_id, product_quantity);
            }
        });
        $(document).on('change', '.cart_qty', function(e) {
            var session_id = $(this).data('session_id');
            var max_product_quantity = $('.product_quantity_' + session_id).val();
            var product_quantity = $(this).val();
            if (product_quantity < 1) {
                product_quantity = 1;
            }
            if (product_quantity > max_product_quantity) {
                product_quantity = max_product_quantity;
                swal({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                    button: false,
                    timer: 1500
                });
            }
            update_cart(session_id, product_quantity);
        });
        $(document).on('click', '#apply_coupon', function(e) {
            var coupon_code = $('#coupon_code').val();
            if (coupon_code != "") {
                $.ajax({
                    url: '{{ url('/apply-coupon') }}',
                    method: 'POST',
                    data: {
                        coupon: coupon_code,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                icon: "success",
                                title: "Thành công",
                                text: "Sử dụng mã giảm giá thành công!",
                                button: false,
                                timer: 1500
                            });
                            load_cart();
                        } else if (data == 0) {
                            swal({
                                icon: "error",
                                title: "Thất bại",
                                text: "Mã giảm giá không đúng!",
                                button: false,
                                timer: 1500
                            });
                        } else if (data == 2) {
                            swal({
                                icon: "error",
                                title: "Thất bại",
                                text: "Mã giảm giá đã hết lượt sử dụng!",
                                button: false,
                                timer: 1500
                            });
                        } else if (data == 3) {
                            swal({
                                icon: "error",
                                title: "Thất bại",
                                text: "Mã giảm giá đã hết hạn!",
                                button: false,
                                timer: 1500
                            });
                        } else if (data == 4) {
                            swal({
                                icon: "error",
                                title: "Thất bại",
                                text: "Vui lòng đăng nhập để sử dụng!",
                                button: false,
                                timer: 1500
                            });
                        } else if (data == 5) {
                            swal({
                                icon: "error",
                                title: "Thất bại",
                                text: "Bạn đã sử dụng mã này rồi!",
                                button: false,
                                timer: 1500
                            });
                        } else if (data == 6) {
                            swal({
                                icon: "error",
                                title: "Thất bại",
                                text: "Mã giảm giá chưa đến lúc dùng!",
                                button: false,
                                timer: 1500
                            });
                        }
                    }
                })
            }
        });
    </script>
@endsection
