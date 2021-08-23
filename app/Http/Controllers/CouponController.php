<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $coupon = Coupon::paginate(5);
        return view('admin.coupon.index')->with(get_defined_vars());    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create')->with(get_defined_vars());    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 $data = $request->validate(
            [
                'coupon_name' => 'required|unique:Blog|max:255',
                'start_day' => 'required',
                'end_day' =>'required',
                'coupon_code' => 'required',
                'coupon_type' => 'required',
                'coupon_number' => 'required|max:255',
                'coupon_status' => 'required|max:255',

            ],
        );
        // $data = $request->all();
        // // dd($data);
         $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->start_day = $data['start_day'];
        $coupon->end_day = $data['end_day'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->coupon_number = (float)$data['coupon_number'];
        $coupon->coupon_status = $data['coupon_status'];

        $coupon->save();      
        return redirect()->back()->with('status','add successs');     }

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
                $coupon = Coupon::find($id);
        return view('admin.coupon.edit')->with(get_defined_vars());    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
$data = $request->validate(
            [
                'coupon_name' => 'required|unique:Blog|max:255',
                'start_day' => 'required',
                'end_day' =>'required',
                'coupon_code' => 'required',
                'coupon_type' => 'required',
                'coupon_number' => 'required|max:255',
                'coupon_status' => 'required|max:255',

            ],
        );
        // $data = $request->all();
        // // dd($data);
         $coupon = Coupon::find($id);
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->start_day = $data['start_day'];
        $coupon->end_day = $data['end_day'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->coupon_number =(float)$data['coupon_number'];
        $coupon->coupon_status = $data['coupon_status'];

        $coupon->save();      
        return redirect()->back()->with('status','add successs');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $coupon = Coupon::find($id);
        
                $coupon->delete();

     return redirect()->back()->with('status','delete success');    }
}
