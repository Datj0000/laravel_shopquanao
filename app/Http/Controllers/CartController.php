<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
session_start();

class CartController extends Controller
{
    public function gio_hang(Request $request)
    {
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        return view('user.cart.cart')
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            echo 0;
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                echo 1;
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['product_name'],
                    'product_id' => $data['product_id'],
                    'product_image' => $data['product_image'],
                    'product_quantity' => $data['product_quantity'],
                    'product_price' => $data['product_price'],
                    'product_size' => $data['product_size'],
                    'product_color' => $data['product_color'],
                );
                Session::put('cart', $cart);
            }
        } else {
            echo 1;
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['product_name'],
                'product_id' => $data['product_id'],
                'product_image' => $data['product_image'],
                'product_quantity' => $data['product_quantity'],
                'product_price' => $data['product_price'],
                'product_size' => $data['product_size'],
                'product_color' => $data['product_color'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }
    public function delete_cart($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            echo 1;
        } else {
            echo 0;
        }
    }
    public function update_cart_ajax(Request $request)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $request->session_id) {
                    $cart[$key]['product_quantity'] = $request->product_quantity;
                }
            }
            Session::put('cart', $cart);
        } else {
            echo 0;
        }
    }
    public function load_cart()
    {
        if (Session::get('cart')) {
            $output = '
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-5">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>';
            $total = 0;
            foreach (Session::get('cart') as $key => $cart) {
                $subtotal = $cart['product_price'] * $cart['product_quantity'];
                $total += $subtotal;
                $total_coupon = 0;
                $output .= '
                <tr class="table_row">
                <td class="column-1">
                    <div data-cart_name="' . $cart['product_name'] . '" data-session_id="' . $cart['session_id'] . '"
                    class="how-itemcart1 delete_cart">
                        <img src="' . asset('public/uploads/product/' . $cart['product_image']) . '" alt="IMG">
                    </div>
                </td>
                <td class="column-2">' . $cart['product_name'] . '</td>
                <td class="column-3">' . number_format($cart['product_price'], 0, ',', '.') . 'đ</td>
                <td class="column-4">
                ';
                $check_qty = Product::where('product_id', $cart['product_id'])->first();
                if($check_qty){
                    $output .= '
                    <input class="product_quantity_' . $cart['session_id'] . '" type="hidden" value="' . $check_qty->product_quantity . '">
                    ';
                }
                $output .= '
                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                        <div data-session_id="' . $cart['session_id'] . '" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-minus"></i>
                        </div>
                        <input data-session_id="' . $cart['session_id'] . '" class="cart_qty mtext-104 cl3 txt-center num-product" type="number" value="' . $cart['product_quantity'] . '">
                        <div data-session_id="' . $cart['session_id'] . '" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-plus"></i>
                        </div>
                </div>
                </td>
                <td class="column-5">' . number_format($subtotal, 0, ',', '.') . 'đ</td>
            </tr>';
            }
            $output .= '
                    </table>
                    </div>
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                               id="coupon_code" placeholder="Mã giảm giá">
                        <div id="apply_coupon"
                                class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Sử dụng
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>
                    <div class="flex-w flex-t p-t-27 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Tổng:
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                <input style="color: #888;" readonly value="' . number_format($total, 0, ',', '.') . ' đ" type="text">
                            </span>
                        </div>
                    </div>
            ';
            if (Session::get('coupon')) {
                foreach (Session::get('coupon') as $key => $cou) {
                    if ($cou['coupon_condition'] == 1) {
                        $total_coupon = ($total * $cou['coupon_number']) / 100;
                        $output .= '
                    <div class="flex-w flex-t p-t-27 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Mã giảm:
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                <input style="color: #888;" readonly value="' . $cou['coupon_number'] . '% (' . number_format($total_coupon, 0, ',', '.') . ' đ)" type="text">
                            </span>
                        </div>
                    </div>
                    ';
                    } else {
                        $total_coupon = $cou['coupon_number'];
                        $output .= '
                        <div class="flex-w flex-t p-t-27 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Mã giảm:
                                </span>
                            </div>
                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    <input style="color: #888;" readonly value="' . number_format($total_coupon, 0, ',', '.') . ' đ" type="text">
                               </span>
                            </div>
                        </div>
                    ';
                    }
                }
            }
            if($total - $total_coupon <0){
                $intomoney = 0;
            }
            else{
                $intomoney = $total - $total_coupon;
            }
            $output .= '
                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Thành tiền:
                            </span>
                        </div>
                        <div class="size-209 p-t-1">
                            <span style="color: #888;" class="mtext-110 cl2">
                            <input style="color: #888;" readonly value="' . number_format($intomoney, 0, ',', '.') . ' đ" type="text">
                            </span>
                        </div>
                    </div>
                    <a href="' . url('/thanh-toan') . '"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Thanh toán
                    </a>
                </div>
            </div>
            ';
        } else {
            $output = '
            <div style="display:block; margin: 0 auto; text-align: center; align-items:center">
                <img style="width:70%" src="' . asset('public/frontend/images/mascot@2x.png') . '">
                <p style="margin: 10px 0">Giỏ hàng của bạn trống</p>
                <div class="flex-w flex-t p-t-27 p-b-33">
                    <a href="' . url('/san-pham') . '"
                        class="center flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>';
        }
        echo $output;
    }
    public function load_subcart()
    {
        $output = '';
        $total = 0;
        $i = 0;
        if (Session::get('cart')) {
            $output .= '<ul class="header-cart-wrapitem w-full">';
            foreach (Session::get('cart') as $key => $cart) {
                $subtotal = $cart['product_price'] * $cart['product_quantity'];
                $total += $subtotal;
                $i++;
                $output .= '
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div data-cart_name="' . $cart['product_name'] . '" data-session_id="' . $cart['session_id'] . '"
                    class="header-cart-item-img delete_cart">
                        <img src="' . asset('public/uploads/product/' . $cart['product_image']) . '" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt p-t-8">
                        <a href="chi-tiet-san-pham/' . $cart['product_id'] . '" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            ' . $cart['product_name'] . '
                        </a>
                        <span class="header-cart-item-info">
                            ' . $cart['product_quantity'] . ' x ' . number_format($cart['product_price'], 0, ',', '.') . 'đ
                        </span>
                    </div>
                </li>';
            }
            $output .= '
                </ul>
                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Tổng: ' . number_format($total, 0, ',', '.') . 'đ
                    </div>
                    <div class="header-cart-buttons flex-w w-full">
                        <a href="' . url('/gio-hang') . '"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">                            Giỏ hàng
                        </a>
                        <a href="' . url('/thanh-toan') . '"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Thanh toán
                        </a>
                    </div>
                </div>
                <input id="subcart_count" type="hidden" value="' . $i . '">
            ';
        } else {
            $output .= '
            <div style="display:block; margin: 0 auto; text-align: center; align-items:center">
                <img style="width:60%" src="' . asset('public/frontend/images/mascot@2x.png') . '">
                <p style="margin: 10px 0">Giỏ hàng của bạn trống</p>
                <input id="subcart_count" type="hidden" value="' . $i . '">
            </div>';
        }
        echo $output;
    }
}
