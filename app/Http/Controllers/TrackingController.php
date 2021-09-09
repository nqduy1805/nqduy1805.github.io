<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Cart;
use App\Models\Order;
use App\Models\Usertraking;
use App\Models\Order_details;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\Pagetracking;
use Carbon\Carbon;
use DB;

class TrackingController extends Controller
{
   //[082123QD] how mani visitor for product and blog / how long
    public function tracking_page(Request $request)
    {
    
    $Page=Pagetracking::where('tracking_id',session('id_traking'))->where('page',session('page'))->first();
    if($Page)
        {
        $Pagetracking=Pagetracking::find($Page->id);
        $Pagetracking->times=$Pagetracking->times+1;
        $Pagetracking->save();
    }
    return 'thành công';
    }
     
    public function user()
    {
        $usertraking = Usertraking::select('ip_adress','country','city','region', DB::raw('count(*) as total'))->OrderBy('updated_at','DESC')->groupBy('ip_adress')->get();
        foreach($usertraking as $u){
            $u->count=(Usertraking::where('ip_adress',$u->ip_adress)->Count())->count();
            $u->phone_times=Usertraking::where('ip_adress',$u->ip_adress)->sum('phone_times');
            $u->mail_times=Usertraking::where('ip_adress',$u->ip_adress)->sum('mail_times');

        }
      return view('admin.tracking.user')->with(get_defined_vars());      }
      public function detail_user(Request $request,$ip)
    {
        $usertraking = Usertraking::where('ip_adress',$ip)->OrderBy('updated_at','DESC')->paginate(5);
      return view('admin.tracking.detail_user')->with(get_defined_vars());      }
        public function traking_detail_page(Request $request,$id)
    {
        
     $pagetraking = Pagetracking::where('tracking_id',$id)->OrderBy('updated_at','DESC')->paginate(5);
      return view('admin.tracking.detail_page')->with(get_defined_vars());    }
       public function product()
    { 
        $product = Product::OrderBy('product_view','DESC')->paginate(5);
    
      return view('admin.tracking.product')->with(get_defined_vars());      }
       public function tracking_detail_product(Request $request,$id)
    {
        $traking = Pagetracking::where('page','like','detail_product'.$id)->get();
        $sumtraking = Pagetracking::where('page','like','detail_product'.$id)->sum('time');
        $sumtraking2 = Pagetracking::where('page','like','detail_product'.$id)->sum('times');
      return view('admin.tracking.detail_product')->with(get_defined_vars());    }
        public function tracking_detail_blog(Request $request,$id)
    {
        $traking = Pagetracking::where('page','detail_blog/'.$id)->get();
        $sumtraking = Pagetracking::where('page','detail_blog/'.$id)->sum('time');
        $sumtraking2 = Pagetracking::where('page','detail_blog/'.$id)->sum('times');
      return view('admin.tracking.detail_blog')->with(get_defined_vars());    }
       public function blog()
    {
        $blog = Blog::OrderBy('product_view','DESC')->paginate(5);
      return view('admin.tracking.blog')->with(get_defined_vars());      }
          //[082123QD]how many click on CTA store: phone, email
       public function tracking_pm(Request $request)
        {        $usertraking = Usertraking::where('_id',session('id_traking'))->first();
       if($request->pm=='mail')
       {
          $usertraking->mail_times=$usertraking->mail_times+1;
          $usertraking->save();
       }
       else{
                  $usertraking->phone_times=$usertraking->phone_times+1;
                            $usertraking->save();       }
    }
}
