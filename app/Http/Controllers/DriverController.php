<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class DriverController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //[082130QD]load driver list
    public function index()
    {
      $user = User::where('role','driver')->paginate(5);
      return view('admin.driver.index')->with(get_defined_vars());      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     //[082130QD]show driver's current location on map, show driver's orders on map, calculate ETA current location driver vs each order address and driver orders bar
       public function map(Request $request,$id)
    {  

        $driver=User::find($id);
        $ip_adress=$driver->ip_adress;
        $url='https://ipinfo.io/'.$ip_adress;
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        $data=curl_exec($ch);
        curl_close($ch); 
        $ar=json_decode($data);
        $loc=explode(',',$ar->loc);
        $driver->loc=$loc[1].','.$loc[0];
        
        $next_order=$driver->loc;
        $min_distance=9999999999999999999999999999999999999999999999999999999999999999999999999;
        if($request->show_all=='off')
            {$order= Order::where('driver_id',$id)->where('order_status','abcdefgh')->orderBy('updated_at','ASC')->get();}
        elseif( $request->chbox)
            {$order = Order::whereNotIn('_id',$request->chbox)->where('driver_id',$id)->where('order_status','driver')->orderBy('updated_at','ASC')->get(); }
            else
       {$order = Order::where('driver_id',$id)->where('order_status','driver')->orderBy('updated_at','ASC')->get();}


        foreach( $order as $od){
        $adress= $od->adress1;
        $adress=str_replace(' ', '+', $adress);
        $url="https://api.mapbox.com/geocoding/v5/mapbox.places/".$adress.".json?limit=1&access_token=pk.eyJ1IjoidG51MTgwNSIsImEiOiJja3N1YTdvcm8xZWx0MnBvNXYzeGFqYm93In0.kUcWi0oiwYzXWXtDXkaFvg";
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        $data=curl_exec($ch);
        curl_close($ch);
        $posi=strpos($data, '"coordinates":');
        $stringpo=substr($data, $posi+15); 
        $arr=explode(']',$stringpo);
        $od->loc= $arr[0];

        $url2='https://api.mapbox.com/directions/v5/mapbox/cycling/'.$driver->loc.';'.$od->loc.'?steps=true&geometries=geojson&access_token=pk.eyJ1IjoidG51MTgwNSIsImEiOiJja3N1YTdvcm8xZWx0MnBvNXYzeGFqYm93In0.kUcWi0oiwYzXWXtDXkaFvg';
        $ch2=curl_init($url2);
        curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
        $data2=curl_exec($ch2);
        curl_close($ch2);
        $posi2=strpos($data2, '"duration":');
        $stringpo2=substr($data2, $posi2+11);
        $arr2=explode(',',$stringpo2);
        $od->duration= $arr2[0];

        $posi3=strpos($data2, '"weight_name":');
        $stringpo3=substr($data2, $posi3+14);

        $posi4=strpos($stringpo3, '"distance":');
        $stringpo4=substr($stringpo3, $posi4+11);

        $arr4=explode('}',$stringpo4);
        $od->distance= $arr4[0];
        if($min_distance>$od->distance)
        { $min_distance= $od->distance;
            $next_order=$od->loc;   }
        }

        $order2 = Order::where('driver_id',$id)->where('order_status','driver')->orderBy('updated_at','ASC')->get();
        return view('admin.driver.map')->with(get_defined_vars());
    }
    //[082130QD]load driver's orders when selected driver
     public function order(Request $request,$id)
    {
     $order = Order::where('driver_id',$id)->paginate(5);
     $id=$id;
      return view('admin.driver.orders')->with(get_defined_vars());
     }
}
