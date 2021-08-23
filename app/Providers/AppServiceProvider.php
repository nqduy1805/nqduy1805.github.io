<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Cart;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Comment;
use App\Models\Usertraking;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
              if(isset(Auth::user()->id)){
            $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
                         if($draft)   {    $order_id=$draft->id;}
                      else 
                    {
                     $order = new Order();
                     $order->user_id=Auth::user()->id;
                     $order->order_status='draft';
                     $order->save();
                     $order_id=$order->id;
                    } 
                      session()->put('order_id',$order_id);
                     $cart=Cart::content();
                     if($cart)
                     {
                         foreach($cart as $ca)
                    {
                    $order_dt= Order_details::where('product_id',$ca->id)->where('order_size',$ca->size)->first();
                     if($order_dt)
                     {
                     $order_dt->order_qty=$ca->qty+$order_dt->order_qty;
                     $order_dt->order_subtotal=$order_dt->order_qty*$order_dt->order_price;
                     $order_dt->save();
                     }else
                     {
                     $order_details = new Order_details();
                     $order_details->order_id= $order_id;
                     $order_details->product_id=$ca->id;
                     $order_details->order_qty=(float)$ca->qty;
                     $order_details->order_price=(float)$ca->price;
                     $order_details->order_sale=(float)$ca->weight;
                     $order_details->order_subtotal=(float)$ca->qty*$ca->price;
                     $order_details->order_size=$ca->size;
                     $order_details->save();
                    }
                   
                    } 
                    Cart::destroy();   
                     }             
                }   
            $discount=0;
                 if(isset(Auth::user()->id)){
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
        $cart=Order_details::where('order_id',$draft->id)->get();
                  $total=(float)Order_details::where('order_id',$draft->id)->get()->sum('order_subtotal');
         }
            else{
                 $cart=Cart::content();
                $total=Cart::subtotal();
                $total=str_replace(',','',$total);
                 $total=(float)$total;
            }
            if(session('coupon.coupon_type')=='percent')
            {
             $discount=$total*(float)session('coupon.coupon_number')/100;
            }
            elseif(session('coupon.coupon_type')=='amount'&&$total>0) {
            $discount=(float)session('coupon.coupon_number');
            }
            $category=Category::get();
            if(session('id_traking')!=null)
            {
            $timenow = Carbon::now('Asia/Ho_Chi_Minh')->format('i:H');
            $usertraking=Usertraking::find(session('id_traking'));
            $date_visit=$usertraking->date_visit;
            $minute1=substr($timenow,0,2);
            $hour1=substr($timenow,3,2);
            $minute=substr($date_visit,3,2);
            $hour=substr($date_visit,6,2);
            $minute1=(int)$minute1+(int)$hour1*60-(int)$minute-(int)$hour*60;
            $minute=(int)$minute1%60;
            $hour=((int)$minute1-(int)$minute)/60;
            $usertraking->time=$hour.':'.$minute;
            $usertraking->save();
            }
            $view->with('category',$category)->with('total',$total)->with('cart',$cart)->with('discount',$discount);
        });
    }
}
