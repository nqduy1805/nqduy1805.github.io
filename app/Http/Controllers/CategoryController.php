<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        $category = Category::paginate(5);
        return view('admin.category.index')->with(get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $category = Category::get();
        return view('admin.category.create')->with(get_defined_vars());
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
                'category_name' => 'required|unique:Category|max:255',
                'category_parent' =>'required|max:255',
                'category_status' =>'required',
            ],
        );
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_parent = $data['category_parent'];
        $category->category_status = $data['category_status'];
        $category->save();
        return redirect()->back()->with('status','Add success');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
         return view('admin.category.edit')->with(get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $category_parent = Category::get();
        return view('admin.category.edit')->with(compact('category','category_parent'));
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
                'category_name' => 'required|unique:Category|max:255',
                'category_parent' =>'required|max:255',
                'category_status' =>'required',
            ],
        );
        $category = Category::find($id);
        $category->category_name = $data['category_name'];
        $category->category_parent = $data['category_parent'];
        $category->category_status = $data['category_status'];
        $category->save();
        return redirect()->back()->with('status','update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('status','delete success');
    }
}
