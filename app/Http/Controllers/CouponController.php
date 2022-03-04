<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function all_coupon()
    {
        return view('admin.all_coupon');
    }
    public function fetchdata()
    {
        $all_coupon = Coupon::get();
        return response()->json([
            "data" => $all_coupon,
        ]);
    }
    public function unactive_coupon($coupon_id)
    {
        Coupon::where('coupon_id', $coupon_id)->update(['coupon_status' => 1]);
    }
    public function active_coupon($coupon_id)
    {
        Coupon::where('coupon_id', $coupon_id)->update(['coupon_status' => 0]);
    }
    public function save_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_date_start = $data['coupon_start'];
        $coupon->coupon_date_end = $data['coupon_end'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_status = $data['coupon_status'];
        $check = $coupon::where('coupon_code', $data['coupon_code'])->first();
        if ($check) {
            echo 0;
        } else {
            $result = $coupon->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function edit_coupon($coupon_id)
    {
        $edit_coupon = Coupon::where('coupon_id', $coupon_id)->first();
        return response()->json([
            'data' => $edit_coupon,
        ]);
    }
    public function update_coupon(Request $request, $coupon_id)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_id', $coupon_id)->first();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_date_start = $data['coupon_start'];
        $coupon->coupon_date_end = $data['coupon_end'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $check_coupon =  Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_id', '!=', $coupon_id)->first();
        if ($check_coupon) {
            echo 0;
        } else {
            $result = $coupon->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::where('coupon_id', $coupon_id);
        $coupon->delete();
    }
    public function check_coupon(Request $request)
    {
        $customer_id = Session::get('customer_id');
        if ($customer_id) {
            $data = $request->all();
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $check_coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->first();
            $check_coupon2 = Coupon::where('coupon_code', $data['coupon'])->where('coupon_date_start', '>=', $today)->first();
            if ($check_coupon) {
                echo 0;
            }
            else if($check_coupon2){
                echo 6;
            }
            else {
                $coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 0)->where('coupon_date_end', '>=', $today)->first();
                if ($coupon) {
                    $count_coupon = $coupon->coupon_used;
                    if ($count_coupon != "") {
                        $check_coupon_used = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 0)->where('coupon_date_end', '>=', $today)
                            ->where('coupon_used', 'LIKE', '%' . $customer_id . '%')->first();
                        if ($check_coupon_used) {
                            $count_coupon = $coupon->count();
                            if ($count_coupon > 0) {
                                $coupon_session = Session::get('coupon');
                                if ($coupon_session == true) {
                                    $is_avaiable = 0;
                                    if ($is_avaiable == 0) {
                                        $cou[] = array(
                                            'coupon_code' => $coupon->coupon_code,
                                            'coupon_condition' => $coupon->coupon_condition,
                                            'coupon_number' => $coupon->coupon_number,

                                        );
                                        Session::put('coupon', $cou);
                                    }
                                } else {
                                    $cou[] = array(
                                        'coupon_code' => $coupon->coupon_code,
                                        'coupon_condition' => $coupon->coupon_condition,
                                        'coupon_number' => $coupon->coupon_number,

                                    );
                                    Session::put('coupon', $cou);
                                }
                                Session::save();
                                echo 1;
                            } else {
                                echo 2;
                            }
                        } else {
                            echo 5;
                        }
                    } else {
                        $count_coupon = $coupon->count();
                        if ($count_coupon > 0) {
                            $coupon_session = Session::get('coupon');
                            if ($coupon_session == true) {
                                $is_avaiable = 0;
                                if ($is_avaiable == 0) {
                                    $cou[] = array(
                                        'coupon_code' => $coupon->coupon_code,
                                        'coupon_condition' => $coupon->coupon_condition,
                                        'coupon_number' => $coupon->coupon_number,

                                    );
                                    Session::put('coupon', $cou);
                                }
                            } else {
                                $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_number' => $coupon->coupon_number,

                                );
                                Session::put('coupon', $cou);
                            }
                            Session::save();
                            echo 1;
                        } else {
                            echo 2;
                        }
                    }
                } else {
                    echo 3;
                }
            }
        } else {
            echo 4;
        }
    }
}
