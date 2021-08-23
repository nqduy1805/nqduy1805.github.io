<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Coupon extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'coupon';
    protected $fillable = [
        'coupon_name','start_day','end_day','coupon_code','coupon_type','coupon_number','coupon_status',
    ];
}
