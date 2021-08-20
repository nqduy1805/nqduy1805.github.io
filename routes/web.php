<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientBlogController;
use App\Http\Controllers\SearchController;


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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('detail_product/{id}', [App\Http\Controllers\HomeController::class, 'detail_product']);
Route::get('all_product/{id}', [App\Http\Controllers\HomeController::class, 'all_product']);
Route::post('quickview', [App\Http\Controllers\HomeController::class, 'quickview']);
Route::post('send_comment', [App\Http\Controllers\HomeController::class, 'send_comment']);
Route::post('load_comment', [App\Http\Controllers\HomeController::class, 'load_comment']);

Route::get('sale', [App\Http\Controllers\HomeController::class, 'sale']);


Route::get('search', [SearchController::class, 'search_product']);
Route::get('filter', [SearchController::class, 'filter']);

Route::get('shopping_bag', [App\Http\Controllers\CartController::class, 'shopping_bag']);
Route::post('add_bag/{id}', [App\Http\Controllers\CartController::class, 'add_bag']);
Route::post('delete_bag/{rowId}', [App\Http\Controllers\CartController::class, 'delete_bag']);
Route::post('update_bag', [App\Http\Controllers\CartController::class, 'update_bag']);
Route::get('checkout', [App\Http\Controllers\CartController::class, 'checkout']);

Route::get('all_blog/{id}', [ClientBlogController::class, 'index']);
Route::get('detail_blog/{id}', [ClientBlogController::class, 'detail']);
Route::post('send_comment_blog', [App\Http\Controllers\ClientBlogController::class, 'send_comment']);
Route::post('load_comment_blog', [App\Http\Controllers\ClientBlogController::class, 'load_comment']);

Route::get('admin.login', [App\Http\Controllers\AdminController::class, 'login']);
Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);
Route::resource('blog',BlogController::class);
Route::resource('order',OrderController::class);
Route::get('detail_order/{id}', [App\Http\Controllers\OrderController::class, 'detail']);


Route::group(['middleware' => ['auth']], function() 
{


});
