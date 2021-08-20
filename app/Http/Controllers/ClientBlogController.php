<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;
use Auth;
use Cart;
use DB;
class ClientBlogController extends Controller
{
 public function index($id)
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
         $blog = Blog::where('category_id',$id)->get();
          $best_seller=Order_details::groupBy('product_id')->orderBy('SUM(order_qty),ASC')->limit(3)->get();

         $blog_popular = Blog::where('category_id',$id)->orderBy('blog_view','DESC')->limit(3)->get();
        return view('pages.all_blog')->with(get_defined_vars());
    }
      
       public function detail($id)
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
        $blog=Blog::find($id);
        $blog->blog_view=$blog->blog_view+1;
         $blog->save();
        return view('pages.detail_blog')->with(get_defined_vars());
    }
      public function load_comment(Request $request)
    {
    
        $blog_id = $request->blog_id;
        $comment = Comment::where('product_id',$blog_id)->get();
        $output = '';
        foreach($comment as $comm){
            $output= $output.' 
                      <li>
                           <div class="comment_right">
                              <div class="comment_info">
                                 <a class="comment_author" href="javascript:void(0);" >'.$comm->name.'</a>
                                 <div class="clear"></div>
                                 <div class="comment_date">'.$comm->updated_at.'</div>
                              </div>'.$comm->comment.'
                             
                           </div>
                           <div class="clear"></div>
                        </li>';
        }
        return $output;

    }
       public function send_comment(Request $request)
    { 
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->name = $request->name;
        $comment->product_id = $request->blog_id;
        $comment->comment_parent= 0;
        $comment->save();
    }
}
