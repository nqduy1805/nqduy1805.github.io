<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Cart;
use session;
use Auth;
use DB;
use Mail;

class CheckoutController extends Controller
{
      public function checkout1()
    {
        if(Auth::user())
        $user=Auth::user();
            else
        $user=new User();
        return view('pages.checkout1')->with(get_defined_vars());

    } 

     public function checkout2(Request $request)
    {
       $data = $request;
        if(session('order_id'))
        $order = Order::find(session('order_id'));
        else
        $order = new Order();
        $order->postcode = $data['postcode'];
        $order->adress1 = $data['adress1'];
        $order->adress2 = $data['adress2'];
        $order->name = $data['name'];
        $order->phone = $data['phone'];
        $order->email = $data['email'];
        $order->save();   
        $order_id=$order->id;
        session()->put('order_id',$order_id);
        return view('pages.checkout2')->with(get_defined_vars());
    } 
    public function checkout3(Request $request)
    {
        $order = Order::find(session('order_id'));
        $data = $request;
        $order->delivery = $data['radio'];
        $order->save();   
        return view('pages.checkout3')->with(get_defined_vars());

    }
     public function checkout4(Request $request)
    {
        $order = Order::find(session('order_id'));
        $data = $request;
        $order->payment = $data['radio'];
        $order->card_number = $data['card_number'];
        $order->save(); 

        return view('pages.checkout4')->with(get_defined_vars());

    }
     public function checkout5(Request $request)
    {   
        $discount=0;
        $order = Order::find(session('order_id'));
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
            foreach($cart as $ca)
        {
        $order_details = new Order_details();
        $order_details->order_id= $order->id;
        $order_details->product_id=$ca->id;
        $order_details->order_qty=(float)$ca->qty;
        $order_details->order_price=(float)$ca->price;
        $order_details->order_sale=(float)$ca->weight;
        $order_details->order_subtotal=(float)$ca->qty*$ca->price;
        $order_details->order_size=$ca->size;
        $order_details->save();
        }
                Cart::destroy();   
            }
            if(session('coupon.coupon_type')=='percent')
            {
             $discount=$total*(float)session('coupon.coupon_number')/100;
            }
            elseif(session('coupon.coupon_type')=='amount'&&$total>0) {
            $discount=(float)session('coupon.coupon_number');
            }
        $order->order_status = 'processing';
        $order->order_total = $total-$discount;
        $order->discount =-$discount;
        $order->save(); 
        //mail customer
        $order_detail = Order_details::where('order_id',session('order_id'))->get();
        $to_name="Shop thoi trang";
        $to_email=$order->email;
        $data= array('order'=>$order,'order_details'=>$order_detail);
         Mail::send('pages.mail.send_mail_order',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Customer contacts');
            $message->from($to_email,$to_name);
        });
        //mail admin
        $to_name="Shop thoi trang";
        $to_email="tnu1805@gmail.com";
        $data= array('order'=>$order,'order_details'=>$order_detail);
         Mail::send('pages.mail.send_mail_order_ad',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Customer contacts');
            $message->from($to_email,$to_name);
        });
        session()->forget('order_id');

        return redirect('shopping_bag');
    }
}
