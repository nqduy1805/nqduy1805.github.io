<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Order_map extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'order_map';
    protected $fillable = [
        'user_id','order_total','order_status','postcode','adress1','adress2','name','phone','email','delivery','payment','card_number','discount','driver_id'
    ];
}
