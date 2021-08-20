<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_details;
use Carbon\Carbon;
use Cart;
use session;
use Auth;
use DB;

class CartController extends Controller
{
   public function add_bag(Request $request,$id)
    {
       $product = Product::find($id);
        if(isset(Auth::user()->id)){
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
         if($draft) $order_id=$draft->id;
         else 
        {
        $order = new Order();
        $order->user_id=Auth::user()->id;
        $order->order_status='draftt';
        $order->save();
        $order_id=$order->id;
        }
        $order_dt= Order_details::where('order_id',$order_id)->where('product_id',$id)->where('order_size',$request->size)->first();
        if($order_dt)
        {
        $order_dt->order_qty=$request->quantity+$order_dt->order_qty;
        $order_dt->order_subtotal=$order_dt->order_qty*$product->product_price;
        $order_dt->save();
        }
        else{
        $order_details = new Order_details();
        $order_details->order_id= $order_id;
        $order_details->product_id=$id;
        $order_details->order_qty=(float)$request->quantity;
        $order_details->order_price=(float)$product->product_price;
        $order_details->order_sale=(float)$product->product_price*(100-$product->product_sale)/100;
        $order_details->order_subtotal=(float)$request->quantity*$order_details->order_sale;
        $order_details->order_size=$request->size;
        $order_details->save();
        }
        }
        else
        {
        $data['id']=$id;
        $data['qty']=$request->quantity;
        $data['price']=(float)$product->product_price*(100-$product->product_sale)/100;
        $data['name']=$product->product_name;
        $data['weight']=(float)$product->product_price;;
        $data['options']['tax']=0;
        $data['options']['image']=$product->product_image;
        $data['options']['size']=$request->size;
        Cart::add($data); 
        }
        return redirect('detail_product/'.$id);
    }
     public function delete_bag(Request $request,$rowId)
    {
        if(isset(auth::user()->id)){
       $order= Order_details::find($rowId);
       $order->delete();
        }
        else
        Cart::remove($rowId);
        return redirect('/shopping_bag');
    }
     public function update_bag(Request $request)
    {
        if(isset(auth::user()->id)){
       $order= Order_details::find($request->id);
       $order->order_qty=(float)$request->quantity;
       $order->order_subtotal=(float)$request->subtotal;
       $order->save();
        }
        else{
            Cart::update($request->id,$request->quantity);
        }

    }
      public function checkout()
    {
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
        $draft->order_status='processing'; 
        $draft->save();
        return redirect('home')->with(get_defined_vars());

    }
     
    public function shopping_bag()
    {
        if(isset(Auth::user()->id)){
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
        $cart=Order_details::where('order_id',$draft->id)->orderBy('updated_at','desc')->get();
        $total=Order_details::where('order_id',$draft->id)->sum('order_subtotal');   
         }
            else{
                 $cart=Cart::content();
                 $total=Cart::subtotal();
            }
                     $category=Category::get();
        return view('pages.shopping_bag')->with(get_defined_vars());
    }
}