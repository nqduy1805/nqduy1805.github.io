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
use App\Models\Pagetracking;

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
            //session()->flush();
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

          $ip_adress=\Request::ip();
          $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('s:i:H d-m-Y');
          $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
          if(session('id_traking')==null)
          {$usertraking=new Usertraking();
           $usertraking->ip_adress=$ip_adress;
           $usertraking->date_visit=$datenow;
           $usertraking->date=$date;
           $usertraking->time=0;

           $ip_adress='14.233.178.189';
           $url='https://ipinfo.io/'.$ip_adress;
           $ch=curl_init($url);
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
           $data=curl_exec($ch);
           curl_close($ch); 
           $ar=json_decode($data);
           $usertraking->city=$ar->city;
           $usertraking->region=$ar->region;
           $usertraking->country=$ar->country;

           $usertraking->save();
           session()->put('id_traking',$usertraking->id);
       }

            if(session('id_traking')!=null)
            {
            $timenow = Carbon::now('Asia/Ho_Chi_Minh')->format('s:i:H');
            $usertraking=Usertraking::find(session('id_traking'));
            $date_visit=$usertraking->date_visit;
            $second1=substr($timenow,0,2);
            $minute1=substr($timenow,3,2);
            $hour1=substr($timenow,6,2);
            $second=substr($date_visit,0,2);
            $minute=substr($date_visit,3,2);
            $hour=substr($date_visit,6,2);
            $second1=(int)$second1+(int)$minute1*60+(int)$hour1*3600-(int)$second-(int)$minute*60-(int)$hour*3600;
            $second=(int)$second1%60;
            $minute1=($second1-$second)/60;
            $minute=(int)$minute1%60;
            $hour=((int)$minute1-(int)$minute)/60;
            $usertraking->time=$hour.':'.$minute.':'.$second;
            $usertraking->save();
            if(session('page')!=null)
            { $Page=Pagetracking::where('tracking_id',session('id_traking'))->where('page',session('page'))->first();
                if($Page)
                {
                      $Pagetracking=Pagetracking::find($Page->id);
                      $Pagetracking->time=(int)$second1-session('pagetime');
                      $Pagetracking->save();
                }
                else{
                $Pagetracking=new Pagetracking();
                $Pagetracking->tracking_id=session('id_traking');
                $Pagetracking->page=session('page');
                $Pagetracking->time=0;
                $Pagetracking->times=1;
                $Pagetracking->save();
                session()->put('pagetime',$second1);
                }
            }
            }
            $view->with('category',$category)->with('total',$total)->with('cart',$cart)->with('discount',$discount);
        });
    }
}
