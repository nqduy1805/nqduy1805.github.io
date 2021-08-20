<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon; 
use App\Models\Blog;
use Auth;
use DB;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $blog = Blog::paginate(5);
      return view('admin.blog.index')->with(get_defined_vars());    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        return view('admin.blog.create')->with(get_defined_vars());
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
                'blog_name' => 'required|unique:Blog|max:255',
                'category_id' => 'required|max:255',
                'blog_image' =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:4048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'blog_summary' => 'required',
                'blog_content' => 'required',
                'blog_author' => 'required|max:255',

            ],
        );
        // $data = $request->all();
        // // dd($data);
         $blog = new blog();
        $blog->blog_name = $data['blog_name'];
        $blog->category_id = $data['category_id'];
        $blog->blog_summary = $data['blog_summary'];
        $blog->blog_content = $data['blog_content'];
        $blog->blog_author = $data['blog_author'];
        $blog->blog_view = 0;
        $blog->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->blog_image;
        $path = 'image/blog/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $blog->blog_image = $new_image;
        $blog->save();      
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
        $blog = Blog::find($id);
        $category = Category::get();
        return view('admin.blog.edit')->with(compact('blog','category'));    }

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
                'blog_name' => 'required|unique:Blog|max:255',
                'category_id' => 'required|max:255',
                'blog_content' => 'required',
                'blog_author' => 'required|max:255',

            ],
        );
        // $data = $request->all();
        // // dd($data);
         $blog = blog::find($id);
        $blog->blog_name = $data['blog_name'];
        $blog->category_id = $data['category_id'];
        $blog->blog_content = $data['blog_content'];
        $blog->blog_summary = $data['blog_summary'];
        $blog->blog_author = $data['blog_author'];
        $blog->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->blog_image)
        {
            $path = 'image/blog/'.$blog->blog_image;
        if(file_exists($path)){
            unlink($path);
        }
        $get_image = $request->blog_image;
        $path = 'image/blog/';

        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $blog->blog_image = $new_image;
        }
        $blog->save();      
        return redirect()->back()->with('status','add successs');   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $blog = blog::find($id);
         $path = 'image/blog/'.$blog->blog_image;
        if(file_exists($path)){
            unlink($path);
        }
                $blog->delete();

     return redirect()->back()->with('status','delete success');

    }
}
