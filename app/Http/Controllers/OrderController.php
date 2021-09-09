<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\OrderStatistics;
use App\Models\User;
use App\Models\Usertraking;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use App\Models\Blog;

class OrderController extends Controller
{
public function index(Request $request)
    {   
        $order = Order::where('order_status','processing')->paginate(5);
        return view('admin.order.index')->with(get_defined_vars());
    }
    public function detail($id)
    {        $order = Order_details::where('order_id',$id)->get();
        return view('admin.order.detail')->with(get_defined_vars());
    }
     public function complete($id)
    {       $order = order::find($id);
            $date= $order->updated_at->format('d m Y');
            $OrderStatistics=OrderStatistics::where('date',$date)->first();
            if($OrderStatistics==null){
                $OrderStatistics=new OrderStatistics();
                $OrderStatistics->date=$date;
                $OrderStatistics->revenue=0;
                 $OrderStatistics->profit=0;
                 $OrderStatistics->total_order=0;
                }
            $OrderStatistics->revenue=$OrderStatistics->revenue+$order->order_total;
            $OrderStatistics->profit=$OrderStatistics->revenue;
            $OrderStatistics->total_order=$OrderStatistics->total_order+1;
            $OrderStatistics->save();
            $order->order_status='complete';
            $order->save();
        return redirect('order');
    }
    
    public function filter_by_date(Request $request)
    {   
     $data = $request->all();

    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    $get = OrderStatistics::whereBetween('date',[$from_date,$to_date])->orderBy('date','ASC')->get();

    return  $get;
    }
    public function chartthismonth(Request $request)
    {    $data = $request->all();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d m Y');
    $thismonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('d m Y');
        $get = OrderStatistics::whereBetween('date',[$thismonth,$now])->orderBy('date','ASC')->get();
    return  $get;
    }
 public function dashboard_filter(Request $request)
    {    $data = $request->all();
    $thismonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('d m Y');
    $lastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('d m Y');



    $week = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->format('d m Y');
    $year = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->format('d m Y');
   // $year =str_replace('-', ' ',  $year);

    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d m Y ');
    if($data['dashboard_value']=='week'){

        $get = OrderStatistics::whereBetween('date',[$week,$now])->orderBy('created_at','ASC')->get();

    }elseif($data['dashboard_value']=='thismonth'){

        $get = OrderStatistics::whereBetween('date',[$thismonth,$now])->orderBy('created_at','ASC')->get();

    }elseif ($data['dashboard_value']=='lastmonth') {

        $get = OrderStatistics::whereBetween('date',[$lastmonth,$thismonth])->orderBy('created_at','ASC')->get();

    }else{
        $get = OrderStatistics::where('date','>',$year)->orderBy('created_at','ASC')->get();
    }

    return  $get;
    }
    public function dashboard()
    {     
        $lastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('Y-m-d');
        $thismonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y-m-d');
        $week = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->format('Y-m-d');
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->format('Y-m-d');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $Total_access_day=Usertraking::where('date',$now)->count();
        $Total_access_week=Usertraking::whereBetween('date',[$week,$now])->count(); 
        $Total_access_last_month=Usertraking::whereBetween('date',[$lastmonth,$thismonth])->count(); 
        $Total_access_this_month=Usertraking::whereBetween('date',[$thismonth,$now])->count();
        $Total_access_year=Usertraking::whereBetween('date',[$year,$now])->count();
        $Total_access=Usertraking::count(); 

        $Total_user_day=Usertraking::where('date',$now)->groupBy('ip_adress')->get()->count();
        $Total_user_week=Usertraking::whereBetween('date',[$week,$now])->groupBy('ip_adress')->get()->count();
        $Total_user_last_month=Usertraking::whereBetween('date',[$lastmonth,$thismonth])->groupBy('ip_adress')->get()->count(); 
        $Total_user_this_month=Usertraking::whereBetween('date',[$thismonth,$now])->groupBy('ip_adress')->get()->count();
        $Total_user_year=Usertraking::whereBetween('date',[$year,$now])->groupBy('ip_adress')->get()->count();
        $Total_user=Usertraking::groupBy('ip_adress')->get()->count();

        $usertraking=Usertraking::orderBy('updated_at','DESC')->first();
        $usertraking2=Usertraking::orderBy('created_at','DESC')->first();
        $Total_user_online=Usertraking::whereBetween('updated_at',[$usertraking2->created_at,$usertraking->updated_at])->groupBy('ip_adress')->get()->count(); 

        $Total_product=Product::count();   
        $Total_blog=Blog::count();   
        $Total_order=order::where('order_status','complete')->count();

        $post_views=Blog::orderBy('blog_view','desc')->limit(5)->get();  
        $product_views=Product::orderBy('product_view','desc')->limit(10)->get();    
      return view('admin.dashboard')->with(get_defined_vars());
    }
    //[092108QD] Create product quantity management for the management page
        public function quantity()
    {
      $product = Product::orderBy('product_quality','ASC')->paginate(5);
      foreach ($product as $value) {
       $value->product_sold=Order_details::where('product_id', $value->id)->sum('order_qty');
      }
      return view('admin.product.qtymanagement')->with(get_defined_vars());
    }
}
