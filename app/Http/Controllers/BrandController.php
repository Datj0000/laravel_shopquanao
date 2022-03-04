<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;

class BrandController extends Controller
{
    public function all_brand()
    {
        return view('admin.all_brand');
    }
    public function fetchdata()
    {
        $all_brand = Brand::all();
        return response()->json([
            "data"=>$all_brand,
        ]);
    }
    public function edit_brand($brand_id)
    {
        $edit_brand = Brand::where('brand_id', $brand_id)->first();
        return response()->json([
            'data'=>$edit_brand,
        ]);
    }
    public function save_brand(Request $request)
    {
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $brand->brand_slug = $data['brand_slug'];
        $check_brand_name = Brand::where('brand_name', $data['brand_name'])->first();
        if ($check_brand_name) {
            echo 0;
        } else {
            $result = $brand->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function unactive_brand($brand_id)
    {
        Brand::where('brand_id', $brand_id)->update(['brand_status' => 1]);
    }
    public function active_brand($brand_id)
    {
        Brand::where('brand_id', $brand_id)->update(['brand_status' => 0]);
    }
    public function update_brand(Request $request,$brand_id)
    {
        $data = $request->all();
        $brand = Brand::where('brand_id', $brand_id)->first();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_slug = $data['brand_slug'];
        $check_brand_name = Brand::where('brand_name', $data['brand_name'])->where('brand_id','!=', $request->brand_id)->first();
        if ($check_brand_name) {
            echo 0;
        } else {
            $result = $brand->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function delete_brand($brand_id)
    {
        $check_category = Product::where('brand_id', $brand_id)->first();
        if ($check_category) {
            echo 0;
        } else {
            $result = Brand::where('brand_id', $brand_id)->delete();
            if ($result) {
                echo 1;
            }
        }
    }
}
