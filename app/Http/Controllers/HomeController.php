<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Cart;
use App\Models\Order;
use App\Models\Usertraking;
use App\Models\Order_details;
use App\Models\Comment;
use Carbon\Carbon;


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
    public function index(Request $request)
    {   
       $ip_adress=$request->ip();
       $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('s:i:H d-m-Y');
       $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
       if(session('id_traking')==null)
       {$usertraking=new Usertraking();
           $usertraking->ip_adress=$ip_adress;
           $usertraking->date_visit=$datenow;
           $usertraking->date=$date;
           $usertraking->time=1;
           $usertraking->save();
           session()->put('id_traking',$usertraking->id);
       }
        $product = Product::orderBy('updated_at','desc')->limit(8)->get();  
        return view('pages.home')->with(get_defined_vars());
    }
    public function access(Request $request)
    {
       $ip_adress=$request->ip();
       $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('s:i:H d-m-Y');
       $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
       if(session('id_traking')==null)
       {$usertraking=new Usertraking();
           $usertraking->ip_adress=$ip_adress;
           $usertraking->date_visit=$datenow;
           $usertraking->date=$date;
           $usertraking->time=1;
           $usertraking->save();
           session()->put('id_traking',$usertraking->id);
       }
             return redirect('home');
    }
    public function detail_product($id)
    {
    
       $product = Product::find($id);
       $product->product_view= $product->product_view+1;
       $product->save();
       $size=$product->product_size;
       $size=explode(',',$size);
       $other_product = Product::where("category_id",$product->category_id)->limit(4)->get();
       
        return view('pages.detail_product')->with(get_defined_vars());
    }
     public function all_product(Request $request,$id)
    {
        $select_ft="";
        $select_ft1="";
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
    {        $product=Product::find($request->product_id);
            $product->product_view= $product->product_view+1;
            $product->save();
            $output['product_name']=$product->product_name;
            $output['product_id']=$request->product_id;
            $output['product_image']=$product->product_image;
            $output['product_image1']=$product->product_image1;
            $output['product_image2']=$product->product_image2;
            $output['product_image3']=$product->product_image3;
            $output['product_price']=$product->product_price;
            $output['price_sale']=$product->product_price*(100-$product->product_sale)/100;
            $size=explode(',',$product->product_size);
            $option=' <select class="basic" name="size">';
            foreach($size as $si){
                         $option=$option.'<option  value='.$si.'>'.$si.'</option>';}
            $option=$option.'</select>';

            $output['product_size']=$option;
            return $output;
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
    {          $product = Product::orderBy('updated_at','desc')->limit(8)->get();  
               return view('pages.sale')->with(get_defined_vars());
    }
     
}