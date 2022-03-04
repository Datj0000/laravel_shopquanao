<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Attributes;
use Attribute;

session_start();

class ProductController extends Controller
{
    //Attributes
    public function all_attributes()
    {
        return view('admin.all_attributes');
    }
    public function fetchdata_attributes()
    {
        $all_attributes = Attributes::all();
        return response()->json([
            "data" => $all_attributes,
        ]);
    }
    public function edit_attributes($attributes_id)
    {
        $edit_attributes = Attributes::where('attributes_id', $attributes_id)->first();
        return response()->json([
            'data' => $edit_attributes,
        ]);
    }
    public function save_attributes(Request $request)
    {
        $data = $request->all();
        $attributes = new Attributes;
        $attributes->attributes_name = $data['attributes_name'];
        $attributes->attributes_value = $data['attributes_value'];
        $check = $attributes::where('attributes_value', $data['attributes_value'])->first();
        if ($check) {
            echo 0;
        } else {
            $result = $attributes->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function update_attributes(Request $request, $attributes_id)
    {
        $data = $request->all();
        $attributes = Attributes::where('attributes_id', $attributes_id)->first();
        $attributes->attributes_name = $data['attributes_name'];
        $attributes->attributes_value = $data['attributes_value'];
        $check = Attributes::where('attributes_value', $data['attributes_value'])->where('attributes_id', '!=', $attributes_id)->first();
        if ($check) {
            echo 0;
        } else {
            $result = $attributes->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function delete_attributes($attributes_id)
    {
        $attributes = Attributes::where('attributes_id', $attributes_id);
        $attributes->delete();
    }
    //Product
    public function all_product()
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        return view('admin.all_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }
    public function fetchdata()
    {
        $all_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('tbl_product.product_id', 'desc')->get();
        return response()->json([
            "data" => $all_product,
        ]);
    }
    public function edit_product($product_id)
    {
        $edit_product = Product::where('product_id', $product_id)->first();
        return response()->json([
            'data' => $edit_product,
        ]);
    }
    public function unactive_product($product_id)
    {
        Product::where('product_id', $product_id)->update(['product_status' => 1]);
    }
    public function active_product($product_id)
    {
        Product::where('product_id', $product_id)->update(['product_status' => 0]);
    }
    public function unfeatured_product($product_id)
    {
        Product::where('product_id', $product_id)->update(['product_top' => 1]);
    }
    public function featured_product($product_id)
    {
        Product::where('product_id', $product_id)->update(['product_top' => 0]);
    }
    public function save_product(Request $request)
    {
        $data = $request->all();
        $product = new Product();
        $product->category_id = $data['product_category'];
        $product->brand_id  =  $data['product_brand'];
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_tags = $data['product_tags'];
        $product->product_top = $data['product_top'];
        $product->product_status = $data['product_status'];
        $get_image = $request->file('product_image');
        $check_name = Product::where('product_slug', $data['product_slug'])->first();
        if ($check_name) {
            echo 0;
        } else {
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/product', $new_image);
                $product->product_image = $new_image;
                $result = $product->save();
                if ($result) {
                    echo 1;
                }
            } else {
                $product->product_image = '';
                $result = $product->save();
                if ($result) {
                    echo 1;
                }
            }
        }
    }
    public function update_product(Request $request, $product_id)
    {
        $data = $request->all();
        $product = Product::where('product_id', $product_id)->first();
        $product->category_id = $data['product_category'];
        $product->brand_id  =  $data['product_brand'];
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_tags = $data['product_tags'];
        $get_image = $request->file('product_image');
        $check_name = Product::where('product_slug', $data['product_slug'])->where('product_id', '!=', $product_id)->first();
        if ($check_name) {
            echo 0;
        } else {
            if ($get_image) {
                $destinationPath = 'public/uploads/product/' . $product->product_image;
                if (file_exists($destinationPath)) {
                    unlink($destinationPath);
                }
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/product', $new_image);
                $product->product_image = $new_image;
                $result = $product->save();
                if ($result) {
                    echo 1;
                }
            } else {
                $product->product_image = $product->product_image;
                $result = $product->save();
                if ($result) {
                    echo 1;
                }
            }
        }
    }
    public function delete_product($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        $destinationPath = 'public/uploads/product/' . $product->product_image;
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $count_gallery = Gallery::where('product_id', $product_id)->count();
        if ($count_gallery) {
            for ($i = 0; $i < $count_gallery; $i++) {
                $gallery2 = Gallery::where('product_id', $product_id)->first();
                $gallery2->delete();
                $destinationPath = 'public/uploads/gallery/' . $gallery2->gallery_image;
                if (file_exists($destinationPath)) {
                    unlink($destinationPath);
                }
            }
        }
        $product->delete();
        echo 1;
    }
    //End Admin Page
    public function details_product($product_slug, Request $request)
    {
        $pro = Product::where('product_slug', $product_slug)->first();
        $product_id = $pro->product_id;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $details_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
            $meta_desc = $value->product_desc;
            $meta_keywords = $value->product_slug;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
        }

        $related_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)
            ->whereNotIn('tbl_product.product_id', [$product_id])->get();

        $gallery = Gallery::where('product_id', $product_id)->get();
        $product = Product::where('product_id', $product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();

        $comment = Comment::where('comment_product_id', $product_id)->get();
        $count_comment = $comment->count();
        return view('user.product.productdetail')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('product_details', $details_product)
            ->with('relate', $related_product)
            ->with('meta_desc', $meta_desc)->with('gallery', $gallery)
            ->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('count_comment', $count_comment);
    }
    public function quick_view($product_id)
    {
        $quick_view = Product::where('product_id', $product_id)->first();
        $quick_view->product_views = $quick_view->product_views + 1;
        $quick_view->save();
        $output = '
        <div class="col-md-6 col-lg-7 p-b-30">
            <div class="p-l-25 p-r-30 p-lr-0-lg">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>
                    <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                    <div class="slick3 gallery-lb">
                        <div class="item-slick3"
                        data-thumb="' . asset('public/uploads/product/' . $quick_view->product_image . '') . '">
                            <div class="wrap-pic-w pos-relative">
                                <img src="' . asset('public/uploads/product/' . $quick_view->product_image . '') . '" alt="IMG-PRODUCT">
                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                    href="' . asset('public/uploads/product/' . $quick_view->product_image . '') . '">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>
                        </div>
                        ';
        $gallery = Gallery::where('product_id', $product_id)->get();
        if ($gallery) {
            foreach ($gallery as $key => $gal) {
                $output .= '
                                <div class="item-slick3"
                                data-thumb="' . asset('public/uploads/gallery/' . $gal->gallery_image . '') . '">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="' . asset('public/uploads/gallery/' . $gal->gallery_image . '') . '" alt="IMG-PRODUCT">
                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="' . asset('public/uploads/gallery/' . $gal->gallery_image . '') . '">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                ';
            }
        }
        $output .= '
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5 p-b-30">
            <div class="p-r-50 p-t-5 p-lr-0-lg">
                <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                    ' . $quick_view->product_name . '
                </h4>

                <span class="mtext-106 cl2">
                    ' . number_format($quick_view->product_price, 0, ',', '.') . ' đ
                </span>

                <p class="stext-102 cl3 p-t-23">
                    Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat
                    ornare feugiat.
                </p>

                <!--  -->
                <div class="p-t-33">
                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-203 flex-c-m respon6">
                            Size
                        </div>

                        <div class="size-204 respon6-next">
                            <div class="rs1-select2 bor8 bg0">
                                <select class="js-select2 product_size_' . $quick_view->product_id . '" name="time">
                                    <option value="">Choose an option</option>
                                    <option value="S">Size S</option>
                                    <option value="M">Size M</option>
                                    <option value="L">Size L</option>
                                    <option value="XL">Size XL</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-203 flex-c-m respon6">
                            Color
                        </div>

                        <div class="size-204 respon6-next">
                            <div class="rs1-select2 bor8 bg0">
                                <select class="js-select2 product_color_' . $quick_view->product_id . '" name="time">
                                    <option value="">Choose an option</option>
                                    <option value="red">Red</option>
                                    <option value="bule">Blue</option>
                                    <option value="white">White</option>
                                    <option value="grey">Grey</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-204 flex-w flex-m respon6-next">
                            <input id="qty_' . $quick_view->product_id . '" type="hidden" value="' . $quick_view->product_quantity . '">
                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                <div onclick="down(this.id)" id="' . $quick_view->product_id . '" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                </div>

                                <input onchange="change(this.id)" id="' . $quick_view->product_id . '" class="mtext-104 cl3 txt-center num-product product_quantity_' . $quick_view->product_id . '" type="number"
                                    name="num-product" value="1">

                                <div onclick="up(this.id)" id="' . $quick_view->product_id . '" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                </div>
                            </div>
                            <input type="hidden" value="' . $quick_view->product_name . '" class="product_name_' . $quick_view->product_id . '">
                            <input type="hidden" value="' . $quick_view->product_price . '" class="product_price_' . $quick_view->product_id . '">
                            <input type="hidden" value="' . $quick_view->product_image . '" class="product_image_' . $quick_view->product_id . '">
                            <button
                                data-product_id="' . $quick_view->product_id . '"
                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                    <div class="flex-m bor9 p-r-10 m-r-11">
                        <a href="#"
                            class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                            data-tooltip="Add to Wishlist">
                            <i class="zmdi zmdi-favorite"></i>
                        </a>
                    </div>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Google Plus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        ';
        echo $output;
    }
    //Gallery
    public function view_gallery($product_id)
    {
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '
        <input type="hidden" id="gallery_product_id" value="' . $product_id . '" />
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th style="width: 25%">STT</th>
                        <th style="text-align: center">Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>

    	';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '
    				<tr>
    				 	<td>' . $i . '</td>
                        <td>
                            <img src="' . url('public/uploads/gallery/' . $gal->gallery_image) . '" class="img-thumbnail" width="120" height="120">
                            <input type="file" class="file_image" data-gal_id="' . $gal->gallery_id . '" id="file-' . $gal->gallery_id . '" name="file" accept="image/*" />
                            <label style="margin-bottom: auto" for="file-' . $gal->gallery_id . '" class="label label-primary label-inline font-weight-lighter mr-2">
                                <i style="color: #fff" class="la la-cloud-upload"></i> Thay ảnh</label>
                            <label style="cursor: pointer; margin-bottom: auto" data-gal_id="' . $gal->gallery_id . '" class="label label-danger label-inline font-weight-lighter mr-2 delete-gallery">
                                <i style="color: #fff" class="la la-trash"></i> Xóa ảnh</label>
                        </td>
                    </tr>
    			';
            }
        } else {
            $output .= '<tr> <td colspan="3">Sản phẩm chưa thư viện ảnh</td></tr>';
        }
        $output .= '
    			</tbody>
    		</table>
        </div>
    	';
        echo $output;
    }
    public function insert_gallery(Request $request, $product_id)
    {
        $get_image = $request->file('gallery_image');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('public/uploads/gallery', $new_image);
                $gallery = new Gallery();
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        echo 1;
    }
    public function delete_gallery(Request $request)
    {
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/uploads/gallery/' . $gallery->gallery_image);
        $gallery->delete();
    }
    public function update_gallery(Request $request)
    {
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if ($get_image) {
            $gallery = Gallery::find($gal_id);
            unlink('public/uploads/gallery/' . $gallery->gallery_image);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/gallery', $new_image);
            $gallery->gallery_image = $new_image;
            $gallery->save();
        }
    }
    //Comment
    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
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
        $comment = Comment::where('comment_id', $data['comment_id'])->first();
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment()
    {
        // $comment = Comment::with('product')->where('comment_parent_comment', '=', 0)->orderBy('comment_id', 'DESC')->get();
        // $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        // return view('admin.all_comment')->with(compact('comment', 'comment_rep'));
        return view('admin.all_comment');
    }
    public function send_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment_content'];
        $comment->comment_name = $data['comment_name'];
        $comment->comment_product_id = $data['product_id'];
        $comment->comment_rating = $data['comment_rating'];
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }
    public function load_comment($product_id)
    {
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', 0)->where('comment_status', 0)->get();
        $comment_rep = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', '>', 0)->get();
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
                        <span class="fs-18 cl11">
                        ';
            for ($i = 0; $i < $comm->comment_rating; $i++) {
                $output .= '<i class="zmdi zmdi-star"></i>';
            }
            $output .= '
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
        $all_comment = Comment::join('tbl_product', 'tbl_product.product_id', '=', 'tbl_comment.comment_product_id')
            ->where('comment_parent_comment', '=', 0)
            ->orderby('tbl_comment.comment_id', 'desc')->get();
        return response()->json([
            "data" => $all_comment,
        ]);
    }
    public function view_reply_comment($comment_id)
    {
        $view = Comment::where('comment_id', $comment_id)->first();
        return response()->json([
            'data' => $view,
        ]);
    }
    public function delete_comment($comment_id)
    {
        $comment = Comment::where('comment_id', $comment_id)->first();
        $comment->delete();
    }
}
