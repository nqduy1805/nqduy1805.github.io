<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\User;

class OrderController extends Controller
{
public function index()
    {        $order = Order::paginate(5);
        return view('admin.order.index')->with(get_defined_vars());
    }
    public function detail($id)
    {        $order = Order_details::where('order_id',$id)->get();
        return view('admin.order.detail')->with(get_defined_vars());
    }

}
