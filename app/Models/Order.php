<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Order extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'order';
    protected $fillable = [
        'user_id','order_total','order_status','postcode','adress1','adress2','name','phone','email','delivery','payment','card_number','discount'
    ];
      public function User(){
        return $this->belongsTo(User::class,'user_id','_id');
    }
}
