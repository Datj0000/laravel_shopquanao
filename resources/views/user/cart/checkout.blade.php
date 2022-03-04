@extends('userlayout')
@section('content')
    {{-- <link rel="stylesheet" href="{{ asset('public/frontend/css/sub.css') }}"> --}}
    <style>
        .checkout__input__checkbox label {
            font-size: 15px;
            color: #0d0d0d;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            margin-bottom: 16px;
            display: block;
        }

        .checkout__input__checkbox label input {
            position: absolute;
            visibility: hidden;
        }

        .checkout__input__checkbox label input:checked~.checkmark {
            border-color: #e53637;
        }

        .checkout__input__checkbox label input:checked~.checkmark:after {
            opacity: 1;
        }

        .checkout__input__checkbox label .checkmark {
            position: absolute;
            left: 0;
            top: 3px;
            height: 14px;
            width: 14px;
            border: 1.5px solid #d7d7d7;
            content: "";
            border-radius: 2px;
        }

        .checkout__input__checkbox label .checkmark:after {
            position: absolute;
            left: 1px;
            top: -3px;
            width: 14px;
            height: 7px;
            border: solid #e53637;
            border-width: 1.5px 1.5px 0px 0px;
            -webkit-transform: rotate(127deg);
            -ms-transform: rotate(127deg);
            transform: rotate(127deg);
            content: "";
            opacity: 0;
        }

        .checkout__input__checkbox p {
            color: #0d0d0d;
            font-size: 14px;
            line-height: 24px;
            margin-bottom: 22px;
        }

    </style>
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ url('/trang-chu') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Thanh toán
            </span>
        </div>
    </div>
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="col-12 p-b-5">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Thông tin giao hàng
                        </h4>
                    </div>
                    <?php
                    $customer_id = Session::get('customer_id');
                    if(isset($customer_id)){
                    ?>
                    <input type="hidden" id="customer_id" value="{{ $customer_id }}">
                    <?php
                        }
                    ?>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3" for="name">Họ tên</label>
                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text">
                    </div>

                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3" for="email">Email</label>
                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text">
                    </div>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3" for="phone">Số điện thoại</label>
                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="phone" type="text">
                    </div>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3">Tỉnh, thành phố:</label>
                        <select class="size-111 bor8 stext-102 cl2 p-lr-20 choose city" id="city">
                            <option value="">Chọn tỉnh thành phố</option>
                            @foreach ($city as $key => $value)
                                <option value="{{ $value->matp }}">{{ $value->name_city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3">Quận, huyện:</label>
                        <select class="size-111 bor8 stext-102 cl2 p-lr-20 choose province" id="province">
                            <option value="">Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3">Xã, phường:</label>
                        <select class="size-111 bor8 stext-102 cl2 p-lr-20 wards" id="wards">
                            <option value="">Chọn xã phường</option>
                        </select>
                    </div>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3" for="address">Địa chỉ</label>
                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="address" type="text">
                    </div>
                    <div class="col-12 p-b-5">
                        <label class="stext-102 cl3" for="review">Chú thích</label>
                        <textarea style="resize: none" class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="note"
                            name="review"></textarea>
                    </div>
                </div>
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Giỏ hàng
                        </h4>
                        <div id="load_checkout"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        load_profile();
        load_checkout();

        function load_profile() {
            var customer_id = $('#customer_id').val();
            $.ajax({
                url: '{{ url('/load-profile/') }}' + '/' + customer_id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                success: function(response) {
                    $('#name').val(response.data.customer_name);
                    $('#email').val(response.data.customer_email);
                    $('#phone').val(response.data.customer_phone);
                }
            })
        }

        function load_checkout() {
            $.ajax({
                url: '{{ url('/load-checkout') }}',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                success: function(data) {
                    $('#load_checkout').html(data);
                }
            })
        }
        $(document).ready(function() {
            $('#city').on('change', function() {
                var matp = $(this).val();
                $.ajax({
                    url: '{{ url('/check-fee/') }}' + '/' + matp,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    success: function(data) {
                        load_checkout();
                    }
                });
            });
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var result = '';

                if (action == 'city') {
                    result = 'province';
                    $('#wards').html('<option value="">Chọn xã phường</option>');
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
            $(document).on('click', '#check_out', function(e) {
                e.preventDefault(e);
                var email = $('#email').val();
                var phone = $('#phone').val();
                var name = $('#name').val();
                var city = $('#city option:selected').text();
                var province = $('#province option:selected').text();
                var wards = $('#wards option:selected').text();
                var address = $('#address').val();
                var note = $('#note').val();
                var order_coupon = $('#order_coupon').val();
                var order_fee = $('#order_fee').val();
                var intomoney = $('#intomoney').val();
                var emailRegex = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm;
                var phoneRegex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
                var shipping_address = address  + ', ' + wards + ', ' + province + ', ' + city;
                var checkbox = document.getElementsByName("payment");
                for (var i = 0; i < checkbox.length; i++) {
                    if (checkbox[i].checked === true) {
                        checkbox = checkbox[i].value;
                    }
                }
                if (email == "" || phone == "" || name == "" || address == "") {
                    swal("", "Vui lòng điền đủ thông tin cá nhân!", "warning");
                } else if (city == "" || province == "") {
                    swal("", "Vui lòng chọn địa chỉ!", "warning");
                } else if (!emailRegex.test(email)) {
                    swal("", "Email không hợp lệ!", "warning");
                } else if (!phoneRegex.test(phone)) {
                    swal("", "Vui lòng kiểm tra lại số điện thoại!", "warning");
                } else if (checkbox != '1' && checkbox != '2') {
                    swal("", "Vui lòng chọn phương thức thanh toán!", "warning");
                } else {
                    $.ajax({
                        url: '{{ url('/check-out') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            shipping_name: name,
                            shipping_email: email,
                            shipping_phone: phone,
                            shipping_note: note,
                            shipping_address: shipping_address,
                            shipping_method: checkbox,
                            order_coupon: order_coupon,
                            order_fee: order_fee,
                            intomoney: intomoney,
                        },
                        success: function(data) {
                            console.log(data);
                            if(data == 1){
                                swal("", "Đặt hàng thành công!", "success");
                                location.reload();
                            }
                            else{
                                    window.location="{{url('/vnpay')}}";
                                }
                        }
                    })
                }
            })
        })
    </script>
@endsection
