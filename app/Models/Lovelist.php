<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Lovelist extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'lovelist';
    protected $fillable = [
        'product_id','user_id'
    ];
    public function Product(){
        return $this->belongsTo(Product::class,'product_id','_id');
    }
          public function User(){
        return $this->belongsTo(User::class,'user_id','_id');
    }
}
