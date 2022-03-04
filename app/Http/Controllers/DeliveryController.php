<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Illuminate\Support\Facades\Session;
session_start();

class DeliveryController extends Controller
{
    public function all_delivery()
    {
        $city = City::get();
        return view('admin.fee_ship')->with('city', $city);
    }
    public function fetchdata()
    {
        $all_delivery = FeeShip::join('tbl_tinhthanhpho', 'tbl_feeship.fee_matp', '=', 'tbl_tinhthanhpho.matp')
            ->select('tbl_feeship.*', 'tbl_tinhthanhpho.name_city')
            ->orderby('tbl_feeship.fee_id', 'desc')->get();
        return response()->json([
            "data" => $all_delivery,
        ]);
    }
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['fee_matp'];
        $fee_ship->fee_feeship = $data['fee_feeship'];
        $check = $fee_ship::where('fee_matp', $data['fee_matp'])->first();
        if ($check) {
            echo 0;
        } else {
            $result = $fee_ship->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option value="">Chọn quận huyện</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {

                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option value="">Chọn xã phường</option>';

                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function edit_delivery($fee_id)
    {
        $edit_delivery = Feeship::where('fee_id', $fee_id)->first();
        return response()->json([
            'data' => $edit_delivery,
        ]);
    }
    public function update_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = Feeship::find($data['fee_id']);
        $fee_ship->fee_matp = $data['fee_matp'];
        $fee_ship->fee_feeship = $data['fee_feeship'];
        $check = $fee_ship::where('fee_matp', $data['fee_matp'])
        ->where('fee_id','!=', $data['fee_id'])
        ->first();
        if ($check) {
            echo 0;
        } else {
            $result = $fee_ship->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function delete_delivery($fee_id)
    {
        $result = Feeship::destroy($fee_id);
        if ($result) {
            echo 1;
        }
    }
    public function check_fee($matp)
    {
        $feeship = Feeship::where('fee_matp',$matp)->get();
        if($feeship){
            $count_feeship = $feeship->count();
            if($count_feeship>0){
                 foreach($feeship as $key => $fee){
                    Session::put('fee',$fee->fee_feeship);
                    Session::save();
                }
            }else{
                Session::put('fee',20000);
                Session::save();
            }
        }
    }
}
