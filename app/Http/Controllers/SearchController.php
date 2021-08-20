<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Cart;
use App\Models\Order;
use App\Models\Order_details;

class SearchController extends Controller
{
public function search_product(Request $request)
    {         if(isset(Auth::user()->id)){
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
        $cart=Order_details::where('order_id',$draft->id)->get();
                  $total=Order_details::get()->sum('order_subtotal');
         }
            else{
                 $cart=Cart::content();
                $total=Cart::total();
            }
                 $category=Category::get();
        $product=Product::where('product_name','like','%'.$request->search.'%')->get();
        return view('pages.all_product')->with(get_defined_vars());
    } 
    public function filter(Request $request)
    {
          if(isset(Auth::user()->id)){
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
        $cart=Order_details::where('order_id',$draft->id)->get();
                  $total=Order_details::get()->sum('order_subtotal');
         }
            else{
                 $cart=Cart::content();
                $total=Cart::total();
            }
                 $category=Category::get();
    $amount_price=$request->amout_price;
    $amount_price=str_replace('$', '',  $amount_price);
    $amount_price=split(",", $amount_price);
    $product=Product::where('product_name','like','%'.$request->search.'%')->where('product_price','>',$amount_price[0])->get();
        return view('pages.all_product')->with(get_defined_vars());
    } 
}
