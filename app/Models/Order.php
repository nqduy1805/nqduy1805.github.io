<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Order extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'order';
    protected $fillable = [
        'user_id','order_total','order_status',
    ];
      public function User(){
        return $this->belongsTo(User::class,'user_id','_id');
    }
}
