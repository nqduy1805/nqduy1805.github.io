<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Order_details extends Eloquent
{
protected $connection = 'mongodb';
    protected $collection = 'order_details';
    protected $fillable = [
        'order_id','product_id','order_name','order_image','order_qty','order_price','order_sale','order_subtotal','order_size',
    ];
    public function Order(){
        return $this->belongsTo(Order::class,'order_id','_id');
    } 
    public function Product(){
        return $this->belongsTo(Product::class,'product_id','_id');
    }
}
