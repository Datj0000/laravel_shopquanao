<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Type" />
    <title>Lấy lại mật khẩu</title>
    <meta name="description" content="Lấy lại mật khẩu">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }

        .text00 {
            color: #1e1e2d;
            font-weight: 500;
            margin: 0;
            font-size: 32px;
            font-family: 'Rubik', sans-serif;
        }

        .text01 {
            color: #455056;
            line-height: 24px;
            margin: 0;
            text-align: left;
        }

        .text02 {
            color: #000;
            text-align: left;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .table thead tr {
            background-color: #20e277;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
        }

        .table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .table tbody tr:last-of-type {
            border-bottom: 2px solid #20e277;
        }

        .table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="https://rakeshmandal.com" title="logo" target="_blank">
                                <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo"
                                    alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 class="text00">
                                            Cảm ơn đã mua sắm ở cửa hàng chúng tôi!</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <h4 class="text02">Thông tin đơn hàng</h4>
                                        <p class="text01">Mã đơn hàng : {{ $code['order_code'] }}</p>
                                        @if ($code['coupon_code'] != 'no')
                                            <p class="text01">Mã khuyến mãi áp dụng :
                                                {{ $code['coupon_code'] }}</p>
                                        @endif
                                        <p class="text01">Phí ship hàng : {{ number_format($shipping_array['fee_ship'], 0, ',', '.') }} đ</p>
                                        <h4 class="text02">Thông tin người nhận</h4>
                                        <p class="text01">Email :
                                            @if ($shipping_array['shipping_email'] == '')
                                                <span class="text01">không có</span>
                                            @else
                                                <span
                                                    class="text01">{{ $shipping_array['shipping_email'] }}</span>
                                            @endif
                                        </p>

                                        <p class="text01">Họ và tên người gửi :
                                            @if ($shipping_array['shipping_name'] == '')
                                                <span class="text01">không có</span>
                                            @else
                                                <span
                                                    class="text01">{{ $shipping_array['shipping_name'] }}</span>
                                            @endif
                                        </p>
                                        <p class="text01">Địa chỉ nhận hàng :
                                            @if ($shipping_array['shipping_address'] == '')
                                                <span class="text01">không có</span>
                                            @else
                                                <span
                                                    class="text01">{{ $shipping_array['shipping_address'] }}</span>
                                            @endif
                                        </p>
                                        <p class="text01">Số điện thoại :
                                            @if ($shipping_array['shipping_phone'] == '')
                                                <span class="text01">Không có</span>
                                            @else
                                                <span
                                                    class="text01">{{ $shipping_array['shipping_phone'] }}</span>
                                            @endif
                                        </p>
                                        <p class="text01">Ghi chú đơn hàng :
                                            @if ($shipping_array['shipping_notes'] == '')
                                                <span class="text01">Không có</span>
                                            @else
                                                <span
                                                    class="text01">{{ $shipping_array['shipping_notes'] }}</span>
                                            @endif
                                        </p>
                                        <p class="text01">Hình thức thanh toán :
                                            @if ($shipping_array['shipping_method'] == 0)
                                                Chuyển khoản ATM
                                            @else
                                                Tiền mặt
                                            @endif
                                        </p>

                                        <h4 class="text02">Sản phẩm đã được chúng tôi xác nhận</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Giá tiền</th>
                                                    <th>Số lượng đặt</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $sub_total = 0;
                                                    $total = 0;
                                                    $coupon_number = 0;
                                                @endphp

                                                @foreach ($cart_array as $cart)

                                                    @php
                                                        $sub_total = $cart['product_qty'] * $cart['product_price'];
                                                        $total += $sub_total;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $cart['product_name'] }}</td>
                                                        <td>{{ number_format($cart['product_price'], 0, ',', '.') }} đ
                                                        </td>
                                                        <td>{{ $cart['product_qty'] }}</td>
                                                        <td>{{ number_format($sub_total, 0, ',', '.') }} đ</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" style="text-align: right">Tổng:
                                                        {{ number_format($total, 0, ',', '.') }} đ</td>
                                                </tr>
                                                @if ($code['coupon_code'] != 'no')
                                                    @if ($code['coupon_condition'] == 1)
                                                        @php
                                                            $coupon_number = ($total * $code['coupon_number']) / 100
                                                        @endphp
                                                        <tr>
                                                            <td colspan="4" style="text-align: right">Giảm giá:
                                                                {{ $code['coupon_number'] }} %</td>
                                                        </tr>
                                                    @endif
                                                    @if ($code['coupon_condition'] == 2)
                                                        @php
                                                            $coupon_number = $code['coupon_number']
                                                        @endphp
                                                        <tr>
                                                            <td colspan="4" style="text-align: right">Giảm giá:
                                                                {{ number_format($coupon_number, 0, ',', '.') }} đ
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                                <?php
                                                if ($total - $coupon_number + $shipping_array['fee_ship'] < 0) {
                                                    $intomoney = 0;
                                                } else {
                                                    $intomoney = $total - $coupon_number + $shipping_array['fee_ship'];
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="4" style="text-align: right">Thành tiền:
                                                        {{ number_format($intomoney, 0, ',', '.') }} đ</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a target="_blank" href="{{ url('/history') }}"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">
                                            Chi tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; <strong>www.sapoquangninh.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>
