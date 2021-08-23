<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(5);
      return view('admin.user.index')->with(get_defined_vars());      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create')->with(get_defined_vars());    }

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
                'name' => 'required|max:255',
                'email' => 'required|max:255|email|unique:users',
                'role' => 'required|max:255',
                'address' => 'required|max:255',
                'gender' => 'required|max:255',
                'phone' => 'required|numeric|min:11',
                'password' => 'required|min:8',
                 'status' => 'required',
                             ],
        );
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->address = $data['address'];
        $user->gender = $data['gender'];
        $user->phone = $data['phone'];
        $user->status = $data['status'];
        $user->password = Hash::make($data['password']);
        $user->save();
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
     $user = User::find($id);
        return view('admin.user.edit')->with(get_defined_vars());    }

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
                'name' => 'required|max:255',
                'email' => 'required|max:255|email|unique:users',
                'role' => 'required|max:255',
                'address' => 'required|max:255',
                'gender' => 'required|max:255',
                'phone' => 'required|max:255',
                'password' => 'required|min:8',

            ],
        );
        $user = User::find($id);
        $user->blog_name = $data['blog_name'];
        return redirect()->back()->with('status','add successs');      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
                $user->delete();
     return redirect()->back()->with('status','delete success');    }
}
