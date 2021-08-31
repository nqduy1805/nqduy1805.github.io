<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientBlogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DriverController;




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

//Route::get('/', function () {
//  return view('templates.layout');
//});

Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);
Route::get('detail_product/{id}', [HomeController::class, 'detail_product']);
Route::get('all_product/{id}', [HomeController::class, 'all_product']);
Route::post('quickview', [HomeController::class, 'quickview']);
Route::post('send_comment', [HomeController::class, 'send_comment']);
Route::post('load_comment', [HomeController::class, 'load_comment']);

Route::get('sale', [HomeController::class, 'sale']);

Route::get('search', [SearchController::class, 'search_product']);
Route::get('filter', [SearchController::class, 'filter']);

Route::get('add_lovelist/{id}', [CartController::class, 'add_lovelist']);
Route::post('delete_lovelist/{id}', [CartController::class, 'delete_lovelist']);

Route::get('shopping_bag', [CartController::class, 'shopping_bag']);
Route::post('add_bag/{id}', [CartController::class, 'add_bag']);
Route::post('delete_bag/{rowId}', [CartController::class, 'delete_bag']);
Route::post('update_bag', [CartController::class, 'update_bag']);
Route::get('checkout1', [CheckoutController::class, 'checkout1']);
Route::get('checkout2', [CheckoutController::class, 'checkout2']);
Route::get('checkout3', [CheckoutController::class, 'checkout3']);
Route::get('checkout4', [CheckoutController::class, 'checkout4']);
Route::get('checkout5', [CheckoutController::class, 'checkout5']);

Route::get('contacts', [MailController::class, 'contacts']);
Route::post('send_contacts', [MailController::class, 'send_contacts']);
Route::get('send_code', [MailController::class, 'send_code']);
Route::get('new_password', [MailController::class, 'new_password']);
Route::get('create_new_password', [MailController::class, 'create_new_password']);
Route::post('send_coupon', [MailController::class, 'send_coupon']);


Route::get('all_blog/{id}', [ClientBlogController::class, 'index']);
Route::get('detail_blog/{id}', [ClientBlogController::class, 'detail']);
Route::post('send_comment_blog', [ClientBlogController::class, 'send_comment']);
Route::post('load_comment_blog', [ClientBlogController::class, 'load_comment']);

Route::get('admin.login', [App\Http\Controllers\AdminController::class, 'login']);
Route::group(['middleware' => 'role'], function() {
Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);
Route::resource('blog',BlogController::class);
Route::resource('order',OrderController::class);
Route::resource('user',UserController::class);
Route::resource('coupon',CouponController::class);

Route::get('admin', [OrderController::class, 'dashboard']);
Route::get('dashboard', [OrderController::class, 'dashboard']);
Route::post('dashboard_filter', [OrderController::class, 'dashboard_filter']);
Route::post('chartthismonth', [OrderController::class, 'chartthismonth']);
Route::post('filter_by_date', [OrderController::class, 'filter_by_date']);
Route::get('detail_order/{id}', [OrderController::class, 'detail']);
Route::get('dashboard', [OrderController::class, 'dashboard']);
Route::get('complete/{id}', [OrderController::class, 'complete']);

Route::get('traking/user', [TrackingController::class, 'user']);
Route::get('detail_user/{ip}', [TrackingController::class, 'detail_user']);
Route::get('traking/product', [TrackingController::class, 'product']);
Route::get('traking/blog', [TrackingController::class, 'blog']);
Route::get('traking_detail_page/{id}', [TrackingController::class, 'traking_detail_page']);
Route::get('tracking_detail_product/{id}', [TrackingController::class, 'tracking_detail_product']);
Route::get('tracking_detail_blog/{id}', [TrackingController::class, 'tracking_detail_blog']);

Route::get('driver/user', [DriverController::class, 'index']);
Route::get('driver/{id}', [DriverController::class, 'order']);
Route::get('map/{id}', [DriverController::class, 'map']);

});

Route::post('tracking_page', [TrackingController::class, 'tracking_page']);
Route::post('tracking_pm', [TrackingController::class, 'tracking_pm']);

Route::group(['middleware' => ['auth']], function() 
{

});
