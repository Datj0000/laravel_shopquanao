<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\City;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Statistical;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

session_start();
class CheckOutController extends Controller
{
    public function print_order($order_code)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_code));
        return $pdf->stream();
    }
    public function print_order_convert($order_code)
    {
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $shipping_id = $ord->shipping_id;
        }
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details_product as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        $output = '';

        $output .= '
        <style>
            body{
                font-family: DejaVu Sans;
                font-size: 14px;
            }
            @page {
                size: A4;
            }
            .logo {
                background-color:#FFFFFF;
                text-align:left;
                float:left;
            }
            .company {
                float:right;
                font-size:16px;
            }
            .footer-left {
                text-align:center;
                padding-top:24px;
                position:relative;
                height: 150px;
                width:50%;
                color:#000;
                float:left;
                font-size: 12px;
                bottom:1px;
            }
            .footer-right {
                text-align:center;
                padding-top:24px;
                position:relative;
                height: 150px;
                width:50%;
                color:#000;
                font-size: 12px;
                float:right;
                bottom:1px;
            }
            .TableData {
                background:#ffffff;
                font: 11px;
                width:100%;
                border-collapse:collapse;
                font-size:12px;
                border:thin solid #d3d3d3;
            }
            .TableData TH {
                background: rgba(0,0,255,0.1);
                text-align: center;
                font-weight: bold;
                color: #000;
                border: solid 1px #ccc;
                height: 24px;
            }
            .TableData TR {
                height: 24px;
                border:thin solid #d3d3d3;
            }
            .TableData TR TD {
                padding-right: 2px;
                padding-left: 2px;
                border:thin solid #d3d3d3;
            }
            .TableData TR:hover {
                background: rgba(0,0,0,0.05);
            }
            .TableData .tong {
                text-align: right;
                font-weight:bold;
                padding-right: 4px;
            }
		</style>
        <div>
            <div class="logo"><img src="../../../public/backend/logo.jpg" /></div>
            <div class="company">C.Ty TNHH Salomon</div>
        </div>
        <br>
        <br>
		<h3><center>HÓA ĐƠN THANH TOÁN</center></h3>
		<h4><center>-------oOo-------</center></h4>
        ';
        $output .= '
        <h4>Thông tin khách hàng</h4>
        Người đặt: ' . $shipping->shipping_name . '<br>
        Địa chỉ: ' . $shipping->shipping_address . '<br>
        Email: ' . $shipping->shipping_email . '<br>
        Điện thoại: ' . $shipping->shipping_phone . '<br>
		<h4>Đơn hàng</h4>
			<table class="TableData">
				<thead>
					<tr>
                        <th>STT</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Đơn giá</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';

        $total = 0;
        $i = 1;
        foreach ($order_details_product as $key => $product) {

            $subtotal = $product->product_price * $product->product_quantity;
            $total += $subtotal;
            $output .= '
					<tr>
                        <td style = "align-items: center">' . $i++ . '</td>
						<td >' . $product->product_name . '</td>
						<td >' . $product->product_quantity . '</td>
						<td >' . number_format($product->product_price, 0, ',', '.') . 'đ' . '</td>
						<td >' . number_format($subtotal, 0, ',', '.') . 'đ' . '</td>
					</tr>';
        }
        if ($coupon_condition == 1) {
            $total_coupon = ($total * $coupon_number) / 100;
        } else {
            $total_coupon = $coupon_number;
        }
        if ($total - $total_coupon + $product->product_feeship < 0) {
            $intomoney = 0;
        } else {
            $intomoney = $total - $total_coupon  + $product->product_feeship;
        }
        if ($product->product_coupon != 'no') {
            $output .= '
            <tr>
                <td colspan="4" class="tong">Giảm giá</td>
                <td >' .  number_format($total_coupon, 0, ',', '.') . 'đ' . '</td>
            </tr>';
        }
        $output .= '
        <tr>
            <td colspan="4" class="tong">Phí ship</td>
            <td >' .  number_format($product->product_feeship, 0, ',', '.') . 'đ' . '</td>
        </tr>
        <tr>
            <td colspan="4" class="tong">Thành tiền</td>
            <td >' .  number_format($intomoney, 0, ',', '.') . 'đ' . '</td>
        </tr>
        ';
        $output .= '
		</table>
		<div class="footer-left"> ......., ngày ... tháng ... năm .....<br/>Khách hàng </div>
        <div class="footer-right"> ......., ngày ... tháng ... năm .....<br/>Nhân viên </div>
		';
        return $output;
    }
    //User
    public function view_vnpay(Request $request)
    {
        $meta_desc = "Thanh toán bằng VNPay";
        $meta_keywords = "VNPay";
        $meta_title = "VNPay";
        $url_canonical = $request->url();
        return view('user.cart.paymentvnpay')
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }
    public function payment_vnpay(Request $request)
    {
        $vnp_TmnCode = "Y4U88XFK"; //Mã website tại VNPAY
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/shopbanhanglaravel/vnpay-return";
        $vnp_TxnRef = strtoupper(substr(md5(microtime()), rand(0, 26), 8)); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return response()->json([
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        ]);
    }
    public function vnpay_return()
    {
        $data = Session::get('info_customer');
        if ($data) {
            if ($data['order_coupon'] != 'no') {
                $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
                $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                $coupon->coupon_time = $coupon->coupon_time - 1;
                $coupon->save();
            }
            $shipping = new Shipping();
            $shipping->shipping_name = $data['shipping_name'];
            $shipping->shipping_email = $data['shipping_email'];
            $shipping->shipping_phone = $data['shipping_phone'];
            $shipping->shipping_address = $data['shipping_address'];
            $shipping->shipping_note = $data['shipping_note'];
            $shipping->shipping_method = $data['shipping_method'];
            $shipping->save();
            $shipping_id = $shipping->shipping_id;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $checkout_code = strtoupper(substr(md5(microtime()), rand(0, 26), 8));
            $order = new Order;
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = $shipping_id;
            $order->order_status = 1;
            $order->order_code = $checkout_code;
            $order->created_at = now();
            $order->save();
            $order_id = $order->order_id;
            if (Session::get('cart') == true) {
                foreach (Session::get('cart') as $key => $cart) {
                    $order_details = new OrderDetails;
                    $order_details->order_id = $order_id;
                    $order_details->product_id = $cart['product_id'];
                    $order_details->product_name = $cart['product_name'];
                    $order_details->product_price = $cart['product_price'];
                    $order_details->product_quantity = $cart['product_quantity'];
                    $order_details->product_color = $cart['product_color'];
                    $order_details->product_size = $cart['product_size'];
                    $order_details->product_coupon = $data['order_coupon'];
                    $order_details->product_feeship = $data['order_fee'];
                    $order_details->save();
                }
            }
            Session::forget('coupon');
            Session::forget('fee');
            Session::forget('cart');
            Session::forget('info_customer');
            return Redirect::to('/')->send();
        } else {
            return Redirect::to('/')->send();
        }
    }
    public function check_out_view(Request $request)
    {
        if (Session::get('cart') == true && Session::get('customer_id') == true) {
            $city = City::get();
            $meta_desc = "Thanh toán đơn hàng của bạn";
            $meta_keywords = "Thanh toán";
            $meta_title = "Thanh toán";
            $url_canonical = $request->url();
            return view('user.cart.checkout')
                ->with('city', $city)
                ->with('meta_desc', $meta_desc)
                ->with('meta_keywords', $meta_keywords)
                ->with('meta_title', $meta_title)
                ->with('url_canonical', $url_canonical);
        } else {
            $meta_desc = "Giỏ hàng của bạn";
            $meta_keywords = "Giỏ hàng";
            $meta_title = "Giỏ hàng";
            $url_canonical = $request->url();
            return view('user.cart.cart')
                ->with('meta_desc', $meta_desc)
                ->with('meta_keywords', $meta_keywords)
                ->with('meta_title', $meta_title)
                ->with('url_canonical', $url_canonical);
        }
    }
    public function check_out(Request $request)
    {
        $data = $request->all();
        if ($data['shipping_method'] == 1) {
            if ($data['order_coupon'] != 'no') {
                $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
                $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                $coupon->coupon_time = $coupon->coupon_time - 1;
                $coupon->save();
            }
            $shipping = new Shipping();
            $shipping->shipping_name = $data['shipping_name'];
            $shipping->shipping_email = $data['shipping_email'];
            $shipping->shipping_phone = $data['shipping_phone'];
            $shipping->shipping_address = $data['shipping_address'];
            $shipping->shipping_note = $data['shipping_note'];
            $shipping->shipping_method = $data['shipping_method'];
            $shipping->save();
            $shipping_id = $shipping->shipping_id;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            do {
                $checkout_code = strtoupper(substr(md5(microtime()), rand(0, 26), 8));
                $check_ordercode = Order::where('ordercode', $checkout_code)->first();
            } while ($check_ordercode);
            $order = new Order;
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = $shipping_id;
            $order->order_status = 1;
            $order->order_code = $checkout_code;
            $order->created_at = now();
            $order->save();
            $order_code = $order->order_code;
            if (Session::get('cart') == true) {
                foreach (Session::get('cart') as $key => $cart) {
                    $order_details = new OrderDetails;
                    $order_details->order_code = $order_code;
                    $order_details->product_id = $cart['product_id'];
                    $order_details->product_name = $cart['product_name'];
                    $order_details->product_price = $cart['product_price'];
                    $order_details->product_quantity = $cart['product_quantity'];
                    $order_details->product_color = $cart['product_color'];
                    $order_details->product_size = $cart['product_size'];
                    $order_details->product_coupon = $data['order_coupon'];
                    $order_details->product_feeship = $data['order_fee'];
                    $order_details->save();
                }
            }
            Session::forget('coupon');
            Session::forget('fee');
            Session::forget('cart');
            echo 1;
        } else if ($data['shipping_method'] == 2) {
            session(['info_customer' => $data]);
            echo 2;
        }
    }
    public function load_checkout()
    {
        $total = 0;
        $i = 0;
        $output = '';
        $output .= '
            <div class="flex-w flex-t bor12 p-b-13">
            ';
        foreach (Session::get('cart') as $key => $cart) {
            $subtotal = $cart['product_price'] * $cart['product_quantity'];
            $total += $subtotal;
            $i++;
            $output .= '
                <div class="size-217">
                    <span class="stext-110 cl2">
                        ' . $i . ', ' . $cart['product_name'] . '
                    </span>
                </div>

                <div class="size-108">
                    <span style="color: #888;" class="mtext-110 cl2">
                        x' . $cart['product_quantity'] . '
                    </span>
                </div>
                ';
        }
        $output .= '
            </div>
            <div class="flex-w flex-t p-b-13 p-t-27">
                <div class="size-208">
                    <span class="stext-110 cl2">
                        Tổng:
                    </span>
                </div>

                <div class="size-209">
                    <span style="color: #888;" class="mtext-110 cl2">
                        ' . number_format($subtotal, 0, ',', '.') . 'đ
                    </span>
                </div>
            </div>
            ';
        if (Session::get('fee')) {
            $total_fee = Session::get('fee');
            $output .= '
                <input type="hidden" id="order_fee" value="' . Session::get('fee') . '">
                <div class="flex-w flex-t p-b-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Phí ship:
                        </span>
                    </div>
                    <div class="size-209">
                        <span style="color: #888;" class="mtext-110 cl2">
                            ' . number_format($total_fee, 0, ',', '.') . 'đ
                        </span>
                    </div>
                </div>
                ';
        } else {
            $total_fee = 0;
            $output .= '
                    <input type="hidden" id="order_fee" value="20000">
                    <div class="flex-w flex-t p-b-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Phí ship:
                        </span>
                    </div>
                    <div class="size-209">
                        <span style="color: #888;" class="mtext-110 cl2">
                            ' . number_format(0, 0, ',', '.') . 'đ
                        </span>
                    </div>
                </div>
                ';
        }
        if (Session::get('coupon')) {
            foreach (Session::get('coupon') as $key => $cou) {
                if ($cou['coupon_condition'] == 1) {
                    $total_coupon = ($total * $cou['coupon_number']) / 100;
                    $output .= '
                        <input type="hidden" id="order_coupon" value="' . $cou['coupon_code'] . '">
                        <div class="flex-w flex-t p-b-13 bor12">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Giảm giá:
                                </span>
                            </div>

                            <div class="size-209">
                                <span style="color: #888;" class="mtext-110 cl2">
                                ' . $cou['coupon_number'] . '% (' . number_format($total_coupon, 0, ',', '.') . ' đ)
                            </span>
                            </div>
                        </div>
                        ';
                } else if ($cou['coupon_condition'] == 2) {
                    $total_coupon = $cou['coupon_number'];
                    $output .= '
                        <input type="hidden" id="order_coupon" value="' . $cou['coupon_code'] . '">
                        <div class="flex-w flex-t p-b-13 bor12">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Giảm giá:
                                </span>
                            </div>

                            <div class="size-209">
                                <span style="color: #888;" class="mtext-110 cl2">
                                    ' . number_format($total_coupon, 0, ',', '.') . 'đ
                            </span>
                            </div>
                        </div>
                        ';
                }
            }
        } else {
            $total_coupon = 0;
            $output .= '
                    <input type="hidden" id="order_coupon" value="no">
                ';
        }
        if ($total < 0) {
            $total = 0;
        }
        if ($total - $total_coupon + $total_fee < 0) {
            $intomoney = 0;
        } else {
            $intomoney = $total - $total_coupon  + $total_fee;
        }
        $output .= '
            <input type="hidden" id="intomoney" value="' . $intomoney . '" />
            <div class="flex-w flex-t p-t-27 bor12 p-b-33">
                <div class="size-208">
                    <span class="stext-110 cl2">
                        Thành tiền:
                    </span>
                </div>

                <div class="size-209 p-t-1">
                    <span style="color: #888;" class="mtext-110 cl2">
                        ' . number_format($intomoney, 0, ',', '.') . 'đ
                    </span>
                </div>
            </div>
            <div style="margin-top: 15px" class="flex-w flex-t p-b-13">
                <div class="checkout__input__checkbox">
                    <label for="paypal">
                        Thanh toán bằng tiền mặt
                        <input value="1" name="payment" type="radio" id="paypal">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="checkout__input__checkbox">
                    <label for="payment">
                        Thanh toán bằng thẻ ngân hàng
                        <input value="2" name="payment" type="radio" id="payment">
                    <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <button id="check_out"
                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                Thanh toán
            </button>
            ';
        echo $output;
    }
    public function load_amount()
    {
        $data = Session::get('info_customer');
        echo $data['intomoney'];
    }
    //Admin
    public function all_order()
    {
        return view('admin.manage_order');
    }
    public function fetchdata()
    {
        $all_order = Order::join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->orderby('tbl_order.order_id', 'desc')->get();
        return response()->json([
            "data" => $all_order,
        ]);
    }
    public function delivery_order(Request $request)
    {
        //update order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        //send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn hàng đã đặt được xác nhận" . ' ' . $now;
        $customer = Customer::where('customer_id', $order->customer_id)->first();
        $data['email'] = $customer->customer_email;

        //lay san pham
        $check_product = OrderDetails::where('order_id', $data['order_id'])->get();
        if ($check_product) {
            foreach ($check_product as $key => $result) {
                $proid = $result->product_id;
                $product = Product::find($proid);
                $cart_array[] = array(
                    'product_name' => $product->product_name,
                    'product_price' => $product->product_price,
                    'product_qty' => $result->product_quantity
                );
            }
        }

        //lay shipping
        $details = OrderDetails::where('order_id', $order->order_id)->first();
        $fee_ship = $details->product_feeship;
        $shipping = Shipping::where('shipping_id', $order->shipping_id)->first();
        $shipping_array = array(
            'fee_ship' =>  $fee_ship,
            'customer_name' => $customer->customer_name,
            'shipping_name' => $shipping->shipping_name,
            'shipping_email' => $shipping->shipping_email,
            'shipping_phone' => $shipping->shipping_phone,
            'shipping_address' => $shipping->shipping_address,
            'shipping_notes' => $shipping->shipping_note,
            'shipping_method' => $shipping->shipping_method
        );
        //lay ma giam gia, lay coupon code
        $coupon = Coupon::where('coupon_code', $details->product_coupon)->first();
        if ($coupon) {
            $coupon_number = $coupon->coupon_number;
            $coupon_condition = $coupon->coupon_condition;
            $ordercode_mail = array(
                'coupon_condition' => $coupon_condition,
                'coupon_number' => $coupon_number,
                'coupon_code' => $details->product_coupon,
                'order_code' => $order->order_code
            );
        } else {
            $ordercode_mail = array(
                'coupon_condition' => 'no',
                'coupon_number' => 'no',
                'coupon_code' => $details->product_coupon,
                'order_code' => $order->order_code
            );
        }
        Mail::send('mail.confirm_order',  ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail); //send this mail with subject
            $message->from($data['email'], $title_mail); //send from this mail
        });

        //order date
        $order_date = Carbon::parse($order->created_at)->format('Y-m-d');
        $statistic = Statistical::where('order_date', $order_date)->get();
        if ($statistic) {
            $statistic_count = $statistic->count();
        } else {
            $statistic_count = 0;
        }
        if ($order->order_status == 2) {
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $qty = 0;

            $check_product = OrderDetails::where('order_id', $data['order_id'])->get();
            if ($check_product) {
                foreach ($check_product as $key => $result) {
                    $proid = $result->product_id;
                    $quantity = $result->product_quantity;
                    $product = Product::find($proid);

                    $product_price = $product->product_price;
                    $product_cost = $product->product_cost;
                    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                    $product->product_quantity = $product->product_quantity - $quantity;
                    $product->product_sold = $product->product_sold + $quantity;
                    //$result = $product->save();

                    $total_order += 1;
                    $sales += $product_price * $quantity;
                    $profit += ($product_cost * $quantity);
                    $qty += $quantity;
                }
                if ($coupon) {
                    if ($coupon_condition == 1) {
                        $coupon_number = ($sales * $coupon_number) / 100;
                    }
                    if ($sales - $coupon_number + $fee_ship < 0) {
                        $sales = 0;
                    } else {
                        $sales = $sales - $coupon_number  + $fee_ship;
                    }
                }
                $profit = $sales - $profit;
                if ($sales - $profit < 0) {
                    $profit = 0;
                }
                //update doanh so db
                if ($statistic_count > 0) {
                    $statistic_update = Statistical::where('order_date', $order_date)->first();
                    $statistic_update->sales = $statistic_update->sales + $sales;
                    $statistic_update->profit =  $statistic_update->profit + $profit;
                    $statistic_update->quantity =  $statistic_update->quantity + $qty;
                    $statistic_update->total_order = $statistic_update->total_order + $total_order;
                    $statistic_update->save();
                } else {
                    $statistic_new = new Statistical();
                    $statistic_new->order_date = $order_date;
                    $statistic_new->sales = $sales;
                    $statistic_new->profit =  $profit;
                    $statistic_new->quantity = $qty;
                    $statistic_new->total_order = $total_order;
                    $statistic_new->save();
                }
            }
        }
        echo 1;
    }
    public function view_order($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        $view_order = Order::join('tbl_order_details', 'tbl_order.order_code', '=', 'tbl_order_details.order_code')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_shipping.*', 'tbl_order_details.*')
            ->where('tbl_order.order_id', $order_id)
            ->first();
        $output = '
        <form class="form">
        <div class="card-body">
        <div class="row form-group">
            <h5 class="modal-title" id="exampleModalLabel">Thông tin khách hàng</h5>
        </div>
        <div class="row">
            <div style="width: 20%">
                Người đặt:
            </div>
            <div style="width: 80%">
                ' . $view_order->shipping_name . '
            </div>
            <div style="width: 20%">
                Địa chỉ:
            </div>
            <div style="width: 80%">
                ' . $view_order->shipping_address . '
            </div>
            <div style="width: 20%">
                Email:
            </div>
            <div style="width: 80%">
                ' . $view_order->shipping_email . '
            </div>
            <div style="width: 20%">
                Điện thoại:
            </div>
            <div style="width: 80%">
                ' . $view_order->shipping_phone . '
            </div>';
        if (!empty($view_order->shipping_note)) {
            $output .= '
            <div style="width: 20%">
                Chú thích:
            </div>
            <div style="width: 80%">
                ' . $view_order->shipping_note . '
            </div>';
        }
        $output .= '
        </div>
        <div style="margin-top: 20px" class="row form-group">
            <h5 class="modal-title" id="exampleModalLabel">Đơn hàng</h5>
        </div>
        <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        ';
        $i = 0;
        $total = 0;
        $order_details = OrderDetails::where('order_code', $order->order_code)->get();
        foreach ($order_details as $key => $product) {
            $i++;
            $subtotal = $product->product_price * $product->product_quantity;
            $total += $subtotal;
            $output .= '
            <tbody>
                <tr>
                    <td>' . $i . '</td>
                    <td>' . $product->product_name . '</td>
                    <td>' . $product->product_quantity . '</td>
                    <td>' . number_format($product->product_price, 0, ',', '.') . 'đ' . '</td>
                    <td>' . $product->product_size . '</td>
                    <td>' . $product->product_color . '</td>
                    <td>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</td>
                <tr>
            </tbody>
            ';
        }
        $output .= '
            </table>
            <div style="margin-top: 20px" class="row form-group">
                <div style="width: 20%">
                   Tổng:
                </div>
                <div style="width: 80%">
                    ' . number_format($total, 0, ',', '.') . 'đ' . '
                </div>';
        if ($product->product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product->product_coupon)->first();

            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;

            if ($coupon_condition == 1) {
                $echo_coupon = $coupon_number . '%';
            } elseif ($coupon_condition == 2) {
                $echo_coupon = number_format($coupon_number, 0, ',', '.') . 'đ';
            }
            $output .= '
            <div style="width: 20%">
                Giảm giá:
            </div>
            <div style="width: 80%">
                ' . $echo_coupon . '
            </div>
            ';
        } else {
            $coupon_number = 0;
        }
        if ($total - $coupon_number + $product->product_feeship < 0) {
            $intomoney = 0;
        } else {
            $intomoney = $total - $coupon_number  + $product->product_feeship;
        }
        $output .= '
                <div style="width: 20%">
                    Phí ship:
                </div>
                <div style="width: 80%">
                    ' . number_format($product->product_feeship, 0, ',', '.') . 'đ' . '
                </div>
                <div style="width: 20%">
                    Thành tiền:
                </div>
                <div style="width: 80%">
                    ' . number_format($intomoney, 0, ',', '.') . 'đ' . '
                </div>
            </div>
        </div>
        </form>
        <div class="card-footer">
            <a target="_blank" href="' . url('/print-order/' . $product->order_code) . '">
                <button type="button" class="btn btn-primary mr-2">
                    <i class="fa fa-print" aria-hidden="true"></i> In hoá đơn
                </button>
            </a>
        </div>
        ';
        echo $output;
    }
}
