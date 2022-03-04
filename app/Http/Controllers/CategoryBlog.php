<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CateBlog;
use App\Models\Blog;
class CategoryBlog extends Controller
{
    public function all_category_blog()
    {
        return view('admin.all_category_blog');
    }
    public function fetchdata()
    {
        $all_category_blog = CateBlog::all();
        return response()->json([
            "data" => $all_category_blog,
        ]);
    }
    public function edit_category_blog($category_blog_id)
    {
        $edit_category_blog = CateBlog::where('category_id', $category_blog_id)->first();
        return response()->json([
            'data' => $edit_category_blog,
        ]);
    }
    public function save_category_blog(Request $request)
    {
        $data = $request->all();
        $category = new CateBlog;
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->category_slug = $data['category_slug'];
        $check_category = CateBlog::where('category_name', $data['category_name'])->first();
        if ($check_category) {
            echo 0;
        } else {
            $result = $category->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function unactive_category_blog($category_blog_id)
    {
        CateBlog::where('category_id', $category_blog_id)->update(['category_status' => 1]);
    }
    public function active_category_blog($category_blog_id)
    {
        CateBlog::where('category_id', $category_blog_id)->update(['category_status' => 0]);
    }
    public function update_category_blog(Request $request, $category_blog_id)
    {
        $data = $request->all();
        $category = CateBlog::where('category_id', $category_blog_id)->first();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->category_slug = $data['category_slug'];
        $check_category = CateBlog::where('category_name', $data['category_name'])
        ->where('category_id', '!=', $category_blog_id)->first();
        if ($check_category) {
            echo 0;
        } else {
            $result = $category->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function delete_category_blog($category_blog_id)
    {
        $check_category = Blog::where('category_id', $category_blog_id)->first();
        if ($check_category) {
            echo 0;
        } else {
            $result = CateBlog::where('category_id', $category_blog_id)->delete();
            if ($result) {
                echo 1;
            }
        }
    }
}
