<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CateBlog;
use App\Models\Blog;
use App\Models\Product;
use App\Models\CommentBlog;

class BlogController extends Controller
{
    public function autocomplete(Request $request){
        $data = $request->all();
        if($data['query']){
            $blog = Blog::where('blog_status',0)->where('blog_name','LIKE','%'.$data['query'].'%')->get();
            if($blog->count() > 0){
                $output = '
                <ul class="dropdown-menu2" style="display:block; z-index: 100">'
                ;
                foreach($blog as $key => $val){
                   $output .= '
                   <li class="li_search">'.$val->blog_name.'</li>
                   ';
                }
                $output .= '</ul>';
                echo $output;
            }
        }
    }
    public function view_blog(Request $request)
    {
        $meta_desc = "Bài viết";
        $meta_keywords = "Bài viết";
        $meta_title = "Bài viết";
        $url_canonical = $request->url();
        $category_blog = CateBlog::where('category_status', '0')->orderBy('category_id', 'DESC')->get();
        $blog = Blog::where([
            'blog_status' => '0'
        ]);
        if ($request->search) {
            $blog_name = $request->search;
            $blog->where('blog_name', 'LIKE', '%' . $blog_name . '%');
        }
        if ($request->danh_muc) {
            $category_slug = $request->danh_muc;
            $category = CateBlog::where('category_slug', $category_slug)->first();
            $category_id = $category->category_id;
            $blog->where('category_id', $category_id);
        }
        $blog = $blog->orderBy('blog_id', 'DESC')->paginate(6)->appends(request()->query());
        $product_top = Product::where('product_status', '0')->where('product_top', '0')->limit(5)->orderBy('product_id', 'desc')->inRandomOrder()->get();
        return view('user.blog.blog')
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('category_blog', $category_blog)
            ->with('product_top', $product_top)
            ->with('blog', $blog);
    }
    public function blog_details($blog_slug, Request $request)
    {
        $category_blog = CateBlog::where('category_status', '0')->orderBy('category_id', 'DESC')->get();
        $blog = Blog::where('blog_slug', $blog_slug)->first();
        $blog_id = $blog->blog_id;
        $details_blog = Blog::where('blog_id', $blog_id)->get();

        foreach ($details_blog as $key => $value) {
            $meta_desc = $value->blog_desc;
            $meta_keywords = $value->blog_slug;
            $meta_title = $value->blog_name;
            $url_canonical = $request->url();
        }
        $product_top = Product::where('product_status', '0')->where('product_top', '0')->limit(5)->orderBy('product_id', 'desc')->inRandomOrder()->get();
        $blog = Blog::where('tbl_blog.blog_slug', $blog_slug)->first();
        $blog->blog_views = $blog->blog_views + 1;
        $blog->save();
        return view('user.blog.blogdetails')
            ->with('category_blog', $category_blog)
            ->with('blog', $details_blog)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('product_top', $product_top);
    }
    public function all_blog()
    {
        $category = CateBlog::orderby('category_id', 'desc')->where('category_status', '0')->get();
        return view('admin.all_blog')->with('cate_blog', $category);
    }
    public function fetchdata()
    {
        $all_blog = Blog::join('tbl_category_blog', 'tbl_category_blog.category_id', '=', 'tbl_blog.category_id')
            ->orderby('tbl_blog.blog_id', 'desc')->get();
        return response()->json([
            "data" => $all_blog,
        ]);
    }
    public function edit_blog($blog_id)
    {
        $edit_blog = Blog::where('blog_id', $blog_id)->first();
        return response()->json([
            'data' => $edit_blog,
        ]);
    }
    public function unactive_blog($blog_id)
    {
        Blog::where('blog_id', $blog_id)->update(['blog_status' => 1]);
    }
    public function active_blog($blog_id)
    {
        Blog::where('blog_id', $blog_id)->update(['blog_status' => 0]);
    }
    public function save_blog(Request $request)
    {
        $data = $request->all();
        $blog = new Blog();
        $blog->category_id = $data['blog_category'];
        $blog->blog_name = $data['blog_name'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->blog_desc = $data['blog_desc'];
        $blog->blog_status = $data['blog_status'];
        $get_image = $request->file('blog_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/blog', $new_image);
            $blog->blog_image = $new_image;
            $result = $blog->save();
            if ($result) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            $blog->blog_image = '';
            $result = $blog->save();
            if ($result) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }
    public function update_blog(Request $request, $blog_id)
    {
        $data = $request->all();
        $blog = Blog::where('blog_id', $blog_id)->first();
        $blog->category_id = $data['blog_category'];
        $blog->blog_name = $data['blog_name'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->blog_desc = $data['blog_desc'];
        $get_image = $request->file('blog_image');
        if ($get_image) {
            $destinationPath = 'public/uploads/blog/' . $blog->blog_image;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/blog', $new_image);
            $blog->blog_image = $new_image;
            $result = $blog->save();
            if ($result) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            $blog->blog_image = $blog->blog_image;
            $result = $blog->save();
            if ($result) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }
    public function delete_blog($blog_id)
    {
        $blog = Blog::where('blog_id', $blog_id)->first();
        $destinationPath = 'public/uploads/blog/' . $blog->blog_image;
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $blog->delete();
        echo 1;
    }
    //Comment
    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new CommentBlog();
        $comment->comment = $data['comment'];
        $comment->comment_blog_id = $data['comment_blog_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_rep = 1;
        $comment->comment_name = 'Coza Store';
        $result = $comment->save();
        if ($result) {
            echo 1;
        }
    }
    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $comment = CommentBlog::where('comment_id', $data['comment_id'])->first();
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment()
    {
        return view('admin.all_comment_blog');
    }
    public function send_comment(Request $request)
    {
        $data = $request->all();
        $comment = new CommentBlog();
        $comment->comment = $data['comment_content'];
        $comment->comment_name = $data['comment_name'];
        $comment->comment_blog_id = $data['blog_id'];
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }
    public function load_comment($blog_id)
    {
        $comment = CommentBlog::where('comment_blog_id', $blog_id)->where('comment_parent_comment', 0)->where('comment_status', 0)->get();
        $comment_rep = CommentBlog::where('comment_blog_id', $blog_id)->where('comment_parent_comment', '>', 0)->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '
                <div class="flex-w flex-t p-b-30">
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        <img src="' . url('public/frontend/images/avatar-01.jpg') . '"alt="AVATAR">
                    </div>
                    <div class="size-207">
                        <div class="flex-w flex-sb-m p-b-17">
                            <span class="mtext-107 cl2 p-r-20">
                                ' . $comm->comment_name . '
                            </span>
                        </div>

                        <p class="stext-102 cl6">
                            ' . $comm->comment . '
                        </p>
                    </div>
                </div>
                ';

            foreach ($comment_rep as $key => $rep_comment) {
                if ($rep_comment->comment_parent_comment == $comm->comment_id) {
                    $output .= '
                        <div style="margin:0px 40px" class="flex-w flex-t p-b-30">
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                <img src="' . url('public/frontend/images/icons/favicon.png') . '"alt="AVATAR">
                            </div>
                            <div class="size-207">
                                <div class="flex-w flex-sb-m p-b-17">
                                    <span class="mtext-107 cl2 p-r-20">
                                        ' .  $rep_comment->comment_name . '
                                    </span>
                                </div>

                                <p class="stext-102 cl6">
                                    ' .  $rep_comment->comment . '
                                </p>
                            </div>
                        </div>';
                }
            }
        }
        echo $output;
    }
    public function fetchdata_comment()
    {
        $all_comment = CommentBlog::join('tbl_blog', 'tbl_blog.blog_id', '=', 'tbl_comment_blog.comment_blog_id')
            ->where('comment_parent_comment', '=', 0)
            ->orderby('tbl_comment_blog.comment_id', 'desc')->get();
        return response()->json([
            "data" => $all_comment,
        ]);
    }
    public function view_reply_comment($comment_id)
    {
        $view = CommentBlog::where('comment_id', $comment_id)->first();
        return response()->json([
            'data' => $view,
        ]);
    }
    public function delete_comment($comment_id)
    {
        $comment = CommentBlog::where('comment_id', $comment_id)->first();
        $comment->delete();
    }
}
