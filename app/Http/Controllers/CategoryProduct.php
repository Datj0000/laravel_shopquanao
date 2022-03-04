<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProductModel;

session_start();

class CategoryProduct extends Controller
{
    public function all_category_product()
    {
        return view('admin.all_category_product');
    }
    public function fetchdata()
    {
        $all_category_product = CategoryProductModel::all();
        return response()->json([
            "data" => $all_category_product,
        ]);
    }
    public function edit_category_product($category_product_id)
    {
        $edit_category_product = CategoryProductModel::where('category_id', $category_product_id)->first();
        return response()->json([
            'data' => $edit_category_product,
        ]);
    }
    public function save_category_product(Request $request)
    {
        $data = $request->all();
        $category = new CategoryProductModel();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->slug_category_product = $data['slug_category_product'];
        $check_category_name = CategoryProductModel::where('category_name', $data['category_name'])->first();
        if ($check_category_name) {
            echo 0;
        } else {
            $result = $category->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function unactive_category_product($category_product_id)
    {
        CategoryProductModel::where('category_id', $category_product_id)->update(['category_status' => 1]);
    }
    public function active_category_product($category_product_id)
    {
        CategoryProductModel::where('category_id', $category_product_id)->update(['category_status' => 0]);
    }
    public function update_category_product(Request $request, $category_product_id)
    {
        $data = $request->all();
        $category = CategoryProductModel::where('category_id', $category_product_id)->first();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->slug_category_product = $data['slug_category_product'];
        $check_category_name = CategoryProductModel::where('category_name', $data['category_name'])->where('category_id', '!=', $request->category_product_id)->first();
        if ($check_category_name) {
            echo 0;
        } else {
            $result = $category->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function delete_category_product($category_product_id)
    {
        $check_category = Product::where('category_id', $category_product_id)->first();
        if ($check_category) {
            echo 0;
        } else {
            $result = CategoryProductModel::where('category_id', $category_product_id)->delete();
            if ($result) {
                echo 1;
            }
        }
    }

    public function export_csv()
    {
    }
    public function import_csv()
    {
    }
}
