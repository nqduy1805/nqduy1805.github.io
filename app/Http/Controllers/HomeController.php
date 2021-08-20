<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Cart;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Comment;

class HomeController extends Controller
{
     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        //check user still login
        // $this->middleware('auth');
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
                
                 if(isset(Auth::user()->id)){
        $draft=Order::where('user_id',Auth::user()->id)->where('order_status','draft')->first(); 
        $cart=Order_details::where('order_id',$draft->id)->get();
                  $total=Order_details::get()->sum('order_subtotal');
         }
            else{
                 $cart=Cart::content();
                $total=Cart::total();
            }
        

        $product = Product::orderBy('updated_at','desc')->limit(8)->get();  
        $category=Category::get();
        return view('pages.home')->with(get_defined_vars());
    }
    public function detail_product($id)
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
       $product = Product::find($id);
       $size=$product->product_size;
        $size=explode(',',$size);
       $other_product = Product::where("category_id",$product->category_id)->limit(4)->get();

        return view('pages.detail_product')->with(get_defined_vars());
    }
     public function all_product(Request $request,$id)
    {
        $select_ft="";
        $select_ft1="";
         //header
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
         //filter
        if(isset($_GET['amount_price']))
        {
        $amount_price=$_GET['amount_price'];
        $amount_price=str_replace('$', '',  $amount_price);
        $amount_price=str_replace(' ', '',  $amount_price);
        $amount_price=explode("-", $amount_price);
        $amount_price_0= (double)$amount_price[0];
        $amount_price_1= (double)$amount_price[1];
        }
        else{
        $amount_price_0=0;
        $amount_price_1=2000;   
        }
         if($request->search)
        $search=$request->search;
        else
        $search=" ";
        if($request->size)
        $size=$request->size;
        else
        $size=",";

        $select_ft="product_price";
        $select_ft1="ASC";
        if($request->select_ft){
        if($request->select_ft=='ASC'||$request->select_ft=='DESC')
        {
                    $select_ft='product_price';
                    $select_ft1=$request->select_ft;
        }
        else
        {
                    $select_ft='updated_at';
                    $select_ft1=str_replace(['O','N'],'',$request->select_ft);
        }
        }

         //output
        $category_page=Category::find($id);
        $product = Product::where('category_id',$id)->where('product_name','like','%'.$search.'%')->where('product_price','>=',$amount_price_0)->where('product_price','<=',$amount_price_1)->where('product_size','like','%'.$size.'%')->orderBy($select_ft,$select_ft1)->paginate(9);
        return view('pages.all_product')->with(get_defined_vars());
    }
      public function quickview(Request $request)
    {
    
            $product=Product::find($request->product_id);
      return $product;
    }
       public function load_comment(Request $request)
    {
    
        $product_id = $request->product_id;
        $comment = Comment::where('product_id',$product_id)->get();
        $output = '';
        foreach($comment as $comm){
            $output= $output.' 
            <li>
                                        <div class="clearfix">
                                            <p class="pull-left"><strong><a href="javascript:void(0);" >'.$comm->name.'</a></strong></p>
                                            <span class="date">'.$comm->updated_at.'</span>
                                            
                                        </div>
                                        <p>'.$comm->comment.'</p>
                                    </li>
                                    ';
        }
        return $output;

    }
       public function send_comment(Request $request)
    { 
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->name = $request->name;
        $comment->product_id = $request->product_id;
        $comment->comment_parent= 0;
        $comment->save();
    }
         public function sale(Request $request)
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
                             $product = Product::orderBy('updated_at','desc')->limit(8)->get();  

               return view('pages.sale')->with(get_defined_vars());

    }
     
}