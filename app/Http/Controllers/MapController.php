<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_map;

class MapController extends Controller
{
    
      public function map(Request $request)
    {
         if($request->driver)
      {$driver_web=$request->driver;}
      else{$driver_web="";}
      if( $request->cbdriver)
            {$cbdriver=$request->cbdriver;}
            else {$cbdriver=[];}
     if($request->show_driver=="off")
     {$show_driver="";}
     else {$show_driver=" ";}
      $driver=Order_map::where('date','like','%'.$show_driver.'%')->whereNotIn('web',$cbdriver)->select('id','web','id','locID')->where('web','<>',$driver_web)->groupBy('web')->get();
      $driver2=Order_map::where('date','like','%'.$show_driver.'%')->whereNotIn('web',$cbdriver)->select('id','web','id','locID')->where('web',$driver_web)->groupBy('web')->first();
      $driver3=Order_map::select('id','web','id','locID')->groupBy('web')->orderBy('web','ASC')->get();


        if( $request->chbox)
            {$chbox=$request->chbox;}
            else {$chbox=[];}
             if($request->show_order=="off")
           {$shw_oreder="";}
           else {$shw_oreder=" ";}
      $order=Order_map::where('date','like','%'.$shw_oreder.'%')->whereNotIn('web',$cbdriver)->whereNotIn('id',$chbox)->where('web','<>',$driver_web)->get();
      $order2=Order_map::where('date','like','%'.$shw_oreder.'%')->whereNotIn('web',$cbdriver)->whereNotIn('id',$chbox)->where('web',$driver_web)->get();
      $order3=Order_map::orderBy('web','ASC')->get();

      foreach( $order as $od){
        $adress= $od->shipAddr;
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
    }
    if($driver2){
                $next_order=$driver2->locID;
        $min_distance=9999999999999999999999999999999999999999999999999999999999999999999999999;
    }


    foreach( $order2 as $od){
        $adress= $od->shipAddr;
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

        $url2='https://api.mapbox.com/directions/v5/mapbox/cycling/'.$driver2->locID.';'.$od->loc.'?steps=true&geometries=geojson&access_token=pk.eyJ1IjoidG51MTgwNSIsImEiOiJja3N1YTdvcm8xZWx0MnBvNXYzeGFqYm93In0.kUcWi0oiwYzXWXtDXkaFvg';
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

        $driver4=Order_map::select('id','web','id','locID')->groupBy('web')->orderBy('web','ASC')->first();
        $center=$driver4->locID;

          return view('admin.map')->with(get_defined_vars());  
    }
}
