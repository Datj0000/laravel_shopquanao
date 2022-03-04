<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\CategoryProductModel;

session_start();
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "Trang chủ của website";
        $meta_keywords = "Trang chủ";
        $meta_title = "Trang chủ";
        $url_canonical = $request->fullUrl();
        return view('user.home')
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }
    public function view_product(Request $request)
    {
        $meta_desc = "Sản phẩm";
        $meta_keywords = "Sản phẩm";
        $meta_title = "Sản phẩm";
        $url_canonical = $request->url();
        $cate_product = CategoryProductModel::where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $product = Product::where([
            'product_status' => '0'
        ]);
        if ($request->search) {
            $product_name = $request->search;
            $product->where('product_name', 'LIKE', '%' . $product_name . '%');
        }
        if ($request->danh_muc) {
            $slug_category_product = $request->danh_muc;
            $category = CategoryProductModel::where('slug_category_product', $slug_category_product)->first();
            $category_id = $category->category_id;
            $product->where('category_id', $category_id);
        }
        if ($request->thuong_hieu) {
            $brand_slug = $request->thuong_hieu;
            $brand = Brand::where('brand_slug', $brand_slug)->first();
            $brand_id = $brand->brand_id;
            $product->where('brand_id', $brand_id);
        }
        if ($request->sort_by) {
            $sort_by = $request->sort_by;
            switch ($sort_by) {
                case 'giam_dan':
                    $product->orderBy('product_price', 'DESC');
                    break;
                case 'tang_dan':
                    $product->orderBy('product_price', 'ASC');
                    break;
                case 'kytu_za':
                    $product->orderBy('product_name', 'DESC');
                    break;
                case 'kytu_az':
                    $product->orderBy('product_name', 'ASC');
                    break;
            }
        }
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    $product->where('product_price', '<', 100000);
                    break;
                case '2':
                    $product->whereBetween('product_price', [100000, 200000]);
                    break;
                case '3':
                    $product->whereBetween('product_price', [200000, 300000]);
                    break;
                case '4':
                    $product->whereBetween('product_price', [300000, 400000]);
                    break;
                case '5':
                    $product->whereBetween('product_price', [400000, 500000]);
                    break;
                case '6':
                    $product->where('product_price', '>', 500000);
                    break;
            }
        }
        $all_product = $product->orderBy('product_id', 'DESC')->paginate(6)->appends(request()->query());

        return view('user.product.product')
            ->with('meta_desc', $meta_desc)
            ->with('all_product', $all_product)
            ->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)
            ->with('cate_product', $cate_product)->with('brand_product', $brand_product)
            ->with('url_canonical', $url_canonical);
    }
    public function load_blog()
    {
        $all_blog = Blog::where('blog_status', '0')->orderBy('blog_id', 'desc')->paginate(3);
        $output = '';
        foreach ($all_blog as $key => $item) {
            $output .= '
            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="blog-detail.html">
                            <div style="height: 350px">
                                <img src="public/uploads/blog/' . $item->blog_image . '" alt="IMG-BLOG">
                            </div>
                        </a>
                    </div>

                    <div class="p-t-15">
                        <div class="stext-107 flex-w p-b-14">
                            <span>
                                Lượt xem ' . $item->blog_views . '
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                Ngày đăng ' . \Carbon\Carbon::parse($item->blog_date)->format('d/m/Y') . '
                            </span>
                        </div>

                        <h4 class="p-b-12">
                            <a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
                                ' . $item->blog_name . '
                            </a>
                        </h4>

                        <p style="text-align: justify;" class="stext-108 cl6">
                            ' . \Illuminate\Support\Str::limit($item->blog_desc, 150, $end = '...') . '
                        </p>
                    </div>
                </div>
            </div>
        ';
        }
        echo $output;
    }
    public function load_more_product(Request $request)
    {
        // if ($request->id > 0) {
        //     $all_product = $product->where('product_id', '<', $request->id)->orderBy('product_id', 'DESC')->paginate(6)->appends(request()->query());
        // } else {
        //     $all_product = $product->orderBy('product_id', 'DESC')->paginate(6)->appends(request()->query());
        // }
        // $output = '';
        // if (!$all_product->isEmpty()) {
        //     foreach ($all_product as $key => $pro) {
        //         $last_id = $pro->product_id;
        //         $output .= '
        // <div class="col-sm-6 col-md-4 col-lg-4 p-b-35">
        // 			<!-- Block2 -->
        // 			<div class="block2">
        // 				<div class="block2-pic hov-img0">
        // 					<img src="public/uploads/product/' . $pro->product_image . '" alt="IMG-PRODUCT">

        // 					<span style="cursor: pointer"
        //                         id="' . $pro->product_id . '" onclick = "quickview(this.id)"
        // 						class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
        // 						Quick View
        // 					</span>
        // 				</div>

        // 				<div class="block2-txt flex-w flex-t p-t-14">
        // 					<div class="block2-txt-child1 flex-col-l ">
        // 						<a href="chi-tiet-san-pham/' . $pro->product_id . '"
        // 							class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
        // 							' . $pro->product_name . '
        // 						</a>

        // 						<span class="stext-105 cl3">
        //                         ' . number_format($pro->product_price, 0, ',', '.') . 'đ
        // 						</span>
        // 					</div>

        // 					<div class="block2-txt-child2 flex-r p-t-3">
        // 						<span style="cursor: pointer" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
        // 							<img class="icon-heart1 dis-block trans-04"
        // 								src="public/frontend/images/icons/icon-heart-01.png" alt="ICON">
        // 							<img class="icon-heart2 dis-block trans-04 ab-t-l"
        // 								src="public/frontend/images/icons/icon-heart-02.png" alt="ICON">
        // 						</span>
        // 					</div>
        // 				</div>
        // 			</div>
        // 		</div>
        //     ';
        //     }
        //     $output .= '
        //     <div id="load-more" data-id="' . $last_id . '" class="flex-c-m flex-w w-full p-t-45">
        //         <span style="cursor: pointer" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
        //             LOAD MORE
        //         </span>
        //     </div>
        //     ';
        // } else {
        //     $output .= '
        //     <div class="flex-c-m flex-w w-full p-t-45">
        //         <span style="cursor: pointer" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
        //             END
        //         </span>
        //     </div>
        //     ';
        // }
        // // echo $output;
    }
    public function load_product_new()
    {
        $all_product = Product::where('product_status', '0')->orderBy('product_id', 'desc')->paginate(8);
        $output = '';
        foreach ($all_product as $key => $pro) {
            $output .= '
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="public/uploads/product/' . $pro->product_image . '" alt="IMG-PRODUCT">

                    <span style="cursor: pointer"
                        id="' . $pro->product_id . '" onclick = "quickview(this.id)"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Quick View
                    </span>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="chi-tiet-san-pham/' . $pro->product_id . '"
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        ' . $pro->product_name . '
                        </a>

                        <span class="stext-105 cl3">
                        ' . $pro->product_price . ' VNĐ
                        </span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        <span style="cursor: pointer" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="public/frontend/images/icons/icon-heart-01.png"
                                alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                src="public/frontend/images/icons/icon-heart-02.png" alt="ICON">
                        </span>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }
    public function load_product_old()
    {
        $all_product = Product::where('product_status', '0')->orderBy('product_id', 'asc')->paginate(8);
        $output = '';
        foreach ($all_product as $key => $pro) {
            $output .= '
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="public/uploads/product/' . $pro->product_image . '" alt="IMG-PRODUCT">

                    <span style="cursor: pointer"
                        id="' . $pro->product_id . '" onclick = "quickview(this.id)"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Quick View
                    </span>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="chi-tiet-san-pham/' . $pro->product_id . '"
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        ' . $pro->product_name . '
                        </a>

                        <span class="stext-105 cl3">
                        ' . $pro->product_price . ' VNĐ
                        </span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        <span style="cursor: pointer" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="public/frontend/images/icons/icon-heart-01.png"
                                alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                src="public/frontend/images/icons/icon-heart-02.png" alt="ICON">
                        </span>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }
    public function load_product_top()
    {
        $all_product = Product::where('product_status', '0')->where('product_top', '0')->orderBy('product_id', 'desc')->inRandomOrder()->paginate(8);
        $output = '';
        foreach ($all_product as $key => $pro) {
            $output .= '
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="public/uploads/product/' . $pro->product_image . '" alt="IMG-PRODUCT">

                    <span style="cursor: pointer"
                        id="' . $pro->product_id . '" onclick = "quickview(this.id)"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Quick View
                    </span>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="chi-tiet-san-pham/' . $pro->product_id . '"
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        ' . $pro->product_name . '
                        </a>

                        <span class="stext-105 cl3">
                        ' . $pro->product_price . ' VNĐ
                        </span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        <span style="cursor: pointer" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="public/frontend/images/icons/icon-heart-01.png"
                                alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                src="public/frontend/images/icons/icon-heart-02.png" alt="ICON">
                        </span>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }
    public function load_product_sold()
    {
        $all_product = Product::where('product_status', '0')->orderBy('product_sold', 'desc')->paginate(8);
        $output = '';
        foreach ($all_product as $key => $pro) {
            $output .= '
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="public/uploads/product/' . $pro->product_image . '" alt="IMG-PRODUCT">

                    <span style="cursor: pointer"
                        id="' . $pro->product_id . '" onclick = "quickview(this.id)"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Quick View
                    </span>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="chi-tiet-san-pham/' . $pro->product_id . '"
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        ' . $pro->product_name . '
                        </a>

                        <span class="stext-105 cl3">
                        ' . $pro->product_price . ' VNĐ
                        </span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        <span style="cursor: pointer" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="public/frontend/images/icons/icon-heart-01.png"
                                alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                src="public/frontend/images/icons/icon-heart-02.png" alt="ICON">
                        </span>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }
    public function autocomplete(Request $request)
    {
        $data = $request->all();
        if ($data['query']) {
            $product = Product::where('product_status', 0)->where('product_name', 'LIKE', '%' . $data['query'] . '%')->get();
            if ($product->count() > 0) {
                $output = '
                <ul class="dropdown-menu2" style="display:block; z-index: 100">';
                foreach ($product as $key => $val) {
                    $output .= '
                   <li class="li_search">' . $val->product_name . '</li>
                   ';
                }
                $output .= '</ul>';
                echo $output;
            }
        }
    }
}
