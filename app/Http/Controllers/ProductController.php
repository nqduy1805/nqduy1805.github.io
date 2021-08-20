<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Auth;
use DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $product = Product::paginate(5);
      return view('admin.product.index')->with(get_defined_vars());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $category = Category::get();
        return view('admin.product.create')->with(get_defined_vars());
    }

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
                'product_name' => 'required|unique:Product|max:255',
                'category_id' => 'required',
                'product_price' => 'required|numeric',
                'product_quality' => 'required|numeric',

                'product_image' =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:4048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',

                'product_image1' =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:4048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',

                'product_image2' =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:4048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',

                'product_image3' =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:4048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',

            ],
        );
        // $data = $request->all();
        // // dd($data);
        $Product = new Product();
        $Product->product_name = $data['product_name'];
        $Product->category_id = $data['category_id'];
        $Product->product_price =  (float)$data['product_price'];
        $Product->product_quality = (float) $data['product_quality'];
        if(isset($request->product_info))
        $Product->product_info = $request->product_info;
        if(isset($request->product_introduce))
        $Product->product_introduce = $request->product_introduce;
        if(isset($request->product_size))
        $Product->product_size = $request->product_size;
        if(isset($request->product_sale))
        $Product->product_sale = $request->product_sale;
        $Product->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->product_image;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image = $new_image;

        $get_image = $request->product_image1;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image1 = $new_image;

          $get_image = $request->product_image2;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image2 = $new_image;

          $get_image = $request->product_image3;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image3 = $new_image;

        $Product->save();      
        return redirect()->back()->with('status','add successs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::get();
        return view('admin.product.edit')->with(get_defined_vars());
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
         $data = $request->validate(
            [
                'product_name' => 'required|max:27',
                'category_id' => 'required',
                'product_price' => 'required|numeric',
                'product_quality' => 'required|numeric',              
            ],
        );
        // $data = $request->all();
        // // dd($data);
        $Product = Product::find($id);
        $Product->product_name = $data['product_name'];
        $Product->category_id = $data['category_id'];
        $Product->product_price = (float)$data['product_price'];
        $Product->product_quality = (float)$data['product_quality'];
        if(isset($request->product_info))
        $Product->product_info = $request->product_info;
        if(isset($request->product_introduce))
        $Product->product_introduce = $request->product_introduce;
        if(isset($request->product_size))
        $Product->product_size = $request->product_size;
        if(isset($request->product_sale))
        $Product->product_sale = $request->product_sale;
        $Product->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        if(isset($request->product_image))
        {
            $path = 'image/product/'.$Product->product_image;
        if(file_exists($path)){
            unlink($path);
        }
        $get_image = $request->product_image;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image = $new_image;

        }
        if(isset($request->product_image1))
        {
            $path = 'image/product/'.$Product->product_image1;
        if(file_exists($path)){
            unlink($path);
        }
        $get_image = $request->product_image1;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image1 = $new_image;
        }
        if(isset($request->product_image2))
        {
            $path = 'image/product/'.$Product->product_image2;
        if(file_exists($path)){
            unlink($path);
        }
          $get_image = $request->product_image2;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image2 = $new_image;
         }
        if(isset($request->product_image3))
        {
            $path = 'image/product/'.$Product->product_image3;
        if(file_exists($path)){
            unlink($path);
        }
          $get_image = $request->product_image3;
        $path = 'image/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $Product->product_image3 = $new_image;
        }
        $Product->save();      
        return redirect()->back()->with('status','add successs');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
         $path = 'image/product/'.$product->product_image;
        if(file_exists($path)){
            unlink($path);
        }
        $path1 = 'image/product/'.$product->product_image1;
        if(file_exists($path1)){
            unlink($path1);
        }
        $path2 = 'image/product/'.$product->product_image2;
        if(file_exists($path2)){
            unlink($path2);
        }
        $path3 = 'image/product/'.$product->product_image3;
        if(file_exists($path3)){
            unlink($path3);
        }
        $product->delete();
        return redirect()->back()->with('status','delete success');
    }
}
