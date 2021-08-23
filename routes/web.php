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
Route::get('shopthoitrang', [HomeController::class, 'access']);
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

Route::get('shopping_bag', [CartController::class, 'shopping_bag']);
Route::post('add_bag/{id}', [CartController::class, 'add_bag']);
Route::post('delete_bag/{rowId}', [CartController::class, 'delete_bag']);
Route::post('update_bag', [CartController::class, 'update_bag']);
Route::get('checkout1', [CheckoutController::class, 'checkout1']);
Route::get('checkout2', [CheckoutController::class, 'checkout2']);
Route::get('checkout3', [CheckoutController::class, 'checkout3']);
Route::get('checkout4', [CheckoutController::class, 'checkout4']);
Route::get('checkout5', [CheckoutController::class, 'checkout5']);



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

Route::get('dashboard', [OrderController::class, 'dashboard']);
Route::post('dashboard_filter', [OrderController::class, 'dashboard_filter']);
Route::post('chartthismonth', [OrderController::class, 'chartthismonth']);
Route::post('filter_by_date', [OrderController::class, 'filter_by_date']);
Route::get('detail_order/{id}', [OrderController::class, 'detail']);
Route::get('dashboard', [OrderController::class, 'dashboard']);
Route::get('complete/{id}', [OrderController::class, 'complete']);
});


Route::group(['middleware' => ['auth']], function() 
{


});
