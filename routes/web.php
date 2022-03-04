<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryBlog;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//User
Route::get('/',[HomeController::class,'index']);
Route::get('/trang-chu',[HomeController::class,'index']);
Route::get('/san-pham',[HomeController::class,'view_product']);
Route::get('/gioi-thieu',[HomeController::class,'index']);
Route::get('/lien-he',[HomeController::class,'index']);
Route::get('/gio-hang',[HomeController::class,'index']);
Route::post('/autocomplete',[HomeController::class,'autocomplete']);
Route::post('/autocomplete-blog',[BlogController::class,'autocomplete']);

Route::post('/load-by-category',[HomeController::class, 'load_by_category']);
Route::post('/load-by-brand',[HomeController::class,'load_by_brand']);
Route::post('/load-more-product',[HomeController::class,'load_more_product']);
Route::get('/load-blog',[HomeController::class,'load_blog']);
Route::get('/load-product-new',[HomeController::class,'load_product_new']);
Route::get('/load-product-old',[HomeController::class,'load_product_old']);
Route::get('/load-product-top',[HomeController::class,'load_product_top']);
Route::get('/load-product-sold',[HomeController::class,'load_product_sold']);

//Customer
Route::get('/all-user',[CustomerController::class,'all_user']);
Route::get('/fetchdata-user',[CustomerController::class,'fetchdata']);
Route::get('/view-role-customer/{customer_id}',[CustomerController::class,'view_role']);
Route::post('/update-customer/{customer_id}',[CustomerController::class,'update_customer']);
Route::get('/delete-customer/{customer_id}',[CustomerController::class,'delete_customer']);

Route::post('/check-user',[MailController::class,'check_user']);
Route::post('/send-token',[MailController::class,'send_token_user']);
Route::get('/view-reset-pass',[CustomerController::class,'view_reset_pass']);
Route::post('/reset-pass',[CustomerController::class,'reset_pass']);
Route::get('/change-pass',[CustomerController::class,'change_pass']);
Route::post('/change-new-pass',[CustomerController::class,'change_new_pass']);

Route::get('/login-google',[CustomerController::class,'login_google']);
Route::get('/google-callback',[CustomerController::class,'callback_google']);
Route::get('/login-facebook',[CustomerController::class,'login_facebook']);
Route::get('/facebook-callback',[CustomerController::class,'callback_facebook']);

//Cart
Route::get('/gio-hang',[CartController::class,'gio_hang']);
Route::get('/load-cart',[CartController::class,'load_cart']);
Route::get('/load-subcart',[CartController::class,'load_subcart']);
Route::post('/add-cart',[CartController::class,'add_cart_ajax']);
Route::get('/delete-cart/{session_id}',[CartController::class,'delete_cart']);
Route::post('/update-cart-ajax',[CartController::class,'update_cart_ajax']);

//Admin
Route::get('/login-admin',[AdminController::class,'login_admin']);
Route::get('/admin',[AdminController::class,'show_admin']);
Route::get('/statistical',[AdminController::class,'statistical']);
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);
Route::get('/logout-admin',[AdminController::class,'logout']);

Route::post('/admin/recover-pass',[MailController::class,'check_admin']);
Route::post('/admin/send-token',[MailController::class,'send_token']);
Route::post('/admin/reset-pass',[AdminController::class,'reset_pass']);
Route::get('/admin/change-pass',[AdminController::class,'change_pass']);
Route::post('/admin/change-new-pass',[AdminController::class,'change_new_pass']);

Route::get('/admin/view-profile',[AdminController::class,'view_profile']);
Route::get('/admin/profile',[AdminController::class,'profile']);
Route::post('/admin/update-profile',[AdminController::class,'update_profile']);

Route::group(['middleware' => 'roles'], function(){
    Route::get('/all-staff',[AdminController::class,'all_staff']);
    Route::get('/fetchdata-staff',[AdminController::class,'fetchdata']);
    Route::post('/signup-admin',[AdminController::class,'add_staff']);
    Route::get('/view-role/{admin_id}',[AdminController::class,'view_role']);
    Route::post('/update-staff/{admin_id}',[AdminController::class,'update_staff']);
    Route::get('/delete-staff/{admin_id}',[AdminController::class,'delete_staff']);
});

//Category-product
Route::get('/all-category-product',[CategoryProduct::class,'all_category_product']);
Route::get('/fetchdata-category',[CategoryProduct::class,'fetchdata']);

Route::post('/save-category-product',[CategoryProduct::class,'save_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class,'update_category_product']);

Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class,'delete_category_product']);
Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class,'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class,'active_category_product']);

//Brand
Route::get('/all-brand',[BrandController::class,'all_brand']);
Route::get('/fetchdata-brand',[BrandController::class,'fetchdata']);

Route::post('/save-brand',[BrandController::class,'save_brand']);
Route::post('/update-brand/{brand_id}',[BrandController::class,'update_brand']);

Route::get('/edit-brand/{brand_id}',[BrandController::class, 'edit_brand']);
Route::get('/delete-brand/{brand_id}',[BrandController::class,'delete_brand']);
Route::get('/unactive-brand/{brand_id}',[BrandController::class,'unactive_brand']);
Route::get('/active-brand/{brand_id}',[BrandController::class,'active_brand']);

//Attribute
Route::get('/all-attributes',[ProductController::class,'all_attributes']);
Route::get('/fetchdata-attributes',[ProductController::class,'fetchdata_attributes']);
Route::post('/save-attributes',[ProductController::class,'save_attributes']);
Route::post('/update-attributes/{attributes_id}',[ProductController::class,'update_attributes']);
Route::get('/edit-attributes/{attributes_id}',[ProductController::class, 'edit_attributes']);
Route::get('/delete-attributes/{attributes_id}',[ProductController::class,'delete_attributes']);

//Product
Route::get('/chi-tiet-san-pham/{product_slug}',[ProductController::class,'details_product']);
Route::get('/all-product',[ProductController::class,'all_product']);
Route::get('/fetchdata-product',[ProductController::class,'fetchdata']);

Route::post('/save-product',[ProductController::class,'save_product']);
Route::post('/update-product/{product_id}',[ProductController::class,'update_product']);

Route::get('/edit-product/{product_id}',[ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);
Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class,'active_product']);
Route::get('/featured-product/{product_id}',[ProductController::class,'featured_product']);
Route::get('/unfeatured-product/{product_id}',[ProductController::class,'unfeatured_product']);
//--
Route::get('/xem-nhanh/{product_id}',[ProductController::class,'quick_view']);
Route::get('/view-gallery/{product_id}',[ProductController::class, 'view_gallery']);
Route::post('/insert-gallery/{product_id}',[ProductController::class,'insert_gallery']);
Route::post('/update-gallery',[ProductController::class,'update_gallery']);
Route::post('/delete-gallery',[ProductController::class,'delete_gallery']);
//
Route::post('/send-comment',[ProductController::class,'send_comment']);
Route::get('/load-comment/{product_id}',[ProductController::class,'load_comment']);
Route::get('/all-comment',[ProductController::class,'list_comment']);
Route::post('/allow-comment',[ProductController::class,'allow_comment']);
Route::post('/reply-comment',[ProductController::class,'reply_comment']);
Route::get('/fetchdata-comment',[ProductController::class,'fetchdata_comment']);
Route::get('/view-reply-comment/{comment_id}',[ProductController::class,'view_reply_comment']);
Route::get('/delete-comment/{comment_id}',[ProductController::class,'delete_comment']);

Route::post('/send-comment-blog',[BlogController::class,'send_comment']);
Route::get('/load-comment-blog/{product_id}',[BlogController::class,'load_comment']);
Route::get('/all-comment-blog',[BlogController::class,'list_comment']);
Route::post('/allow-comment-blog',[BlogController::class,'allow_comment']);
Route::post('/reply-comment-blog',[BlogController::class,'reply_comment']);
Route::get('/fetchdata-comment-blog',[BlogController::class,'fetchdata_comment']);
Route::get('/view-reply-comment-blog/{comment_id}',[BlogController::class,'view_reply_comment']);
Route::get('/delete-comment-blog/{comment_id}',[BlogController::class,'delete_comment']);

//Login
Route::get('/login',[CustomerController::class,'show_login']);
Route::get('/login-user',[CustomerController::class,'show_login_user']);
Route::get('/signup-user',[CustomerController::class,'show_signup_user']);
Route::get('/forgotpass-user',[CustomerController::class,'show_forgotpass_user']);

Route::post('/signup',[CustomerController::class,'signup_customer']);
Route::post('/login',[CustomerController::class,'login_customer']);
Route::get('/logout',[CustomerController::class,'logout_customer']);
Route::get('/check-login-user',[CustomerController::class,'AuthLogin']);
Route::get('/load-profile/{customer_id}',[CustomerController::class,'load_profile']);

//CheckOut
Route::get('/thanh-toan',[CheckOutController::class,'check_out_view']);
Route::post('/check-out',[CheckOutController::class,'check_out']);
Route::get('/load-checkout',[CheckOutController::class,'load_checkout']);
Route::get('/vnpay',[CheckOutController::class,'view_vnpay']);
Route::post('/payment-vnpay',[CheckOutController::class,'payment_vnpay']);
Route::get('/vnpay-return',[CheckOutController::class,'vnpay_return']);
Route::get('/load-amount',[CheckOutController::class,'load_amount']);

//Coupon
Route::get('/all-coupon',[CouponController::class,'all_coupon']);
Route::get('/fetchdata-coupon',[CouponController::class,'fetchdata']);

Route::post('/save-coupon',[CouponController::class,'save_coupon']);
Route::get('/edit-coupon/{coupon_id}',[CouponController::class, 'edit_coupon']);
Route::post('/update-coupon/{coupon_id}',[CouponController::class,'update_coupon']);
Route::get('/delete-coupon/{coupon_id}',[CouponController::class,'delete_coupon']);
Route::get('/unactive-coupon/{coupon_id}',[CouponController::class,'unactive_coupon']);
Route::get('/active-coupon/{coupon_id}',[CouponController::class,'active_coupon']);

Route::post('/apply-coupon',[CouponController::class,'check_coupon']);

//Order
Route::get('/all-order',[CheckOutController::class,'all_order']);
Route::get('/fetchdata-order',[CheckOutController::class,'fetchdata']);
Route::get('/view-order/{order_id}',[CheckOutController::class,'view_order']);
Route::post('/delivery-order',[CheckOutController::class,'delivery_order']);
Route::get('/print-order/{order_id}',[CheckOutController::class,'print_order']);

//FeeShip(Delivery)
Route::get('/all-delivery',[DeliveryController::class,'all_delivery']);
Route::get('/fetchdata-delivery',[DeliveryController::class,'fetchdata']);
Route::post('/insert-delivery',[DeliveryController::class,'insert_delivery']);
Route::get('/edit-delivery/{fee_id}',[DeliveryController::class,'edit_delivery']);
Route::post('/update-delivery/{fee_id}',[DeliveryController::class,'update_delivery']);
Route::get('/delete-delivery/{fee_id}',[DeliveryController::class,'delete_delivery']);
Route::post('/select-delivery',[DeliveryController::class,'select_delivery']);
Route::get('/check-fee/{matp}',[DeliveryController::class,'check_fee']);

//Blog
Route::get('/bai-viet',[BlogController::class,'view_blog']);
Route::get('/chi-tiet-bai-viet/{blog_slug}',[BlogController::class,'blog_details']);
Route::get('/all-category-blog',[CategoryBlog::class,'all_category_blog']);
Route::get('/fetchdata-category-blog',[CategoryBlog::class,'fetchdata']);
Route::post('/save-category-blog',[CategoryBlog::class,'save_category_blog']);
Route::post('/update-category-blog/{category_blog_id}',[CategoryBlog::class,'update_category_blog']);
Route::get('/edit-category-blog/{category_blog_id}',[CategoryBlog::class, 'edit_category_blog']);
Route::get('/delete-category-blog/{category_blog_id}',[CategoryBlog::class,'delete_category_blog']);
Route::get('/unactive-category-blog/{category_blog_id}',[CategoryBlog::class,'unactive_category_blog']);
Route::get('/active-category-blog/{category_blog_id}',[CategoryBlog::class,'active_category_blog']);

Route::get('/all-blog',[BlogController::class,'all_blog']);
Route::get('/fetchdata-blog',[BlogController::class,'fetchdata']);
Route::post('/save-blog',[BlogController::class,'save_blog']);
Route::post('/update-blog/{blog_id}',[BlogController::class,'update_blog']);
Route::get('/edit-blog/{blog_id}',[BlogController::class, 'edit_blog']);
Route::get('/delete-blog/{blog_id}',[BlogController::class,'delete_blog']);
Route::get('/unactive-blog/{blog_id}',[BlogController::class,'unactive_blog']);
Route::get('/active-blog/{blog_id}',[BlogController::class,'active_blog']);

//
Route::post('/filter-by-date',[AdminController::class,'filter_by_date']);

//
// Route::get('/all-user',[AdminController::class,'all_user']);
// Route::get('/fetchdata-user',[AdminController::class,'fetchdata']);
