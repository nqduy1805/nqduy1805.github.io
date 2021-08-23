<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OrderStatistics extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'orderstatistics';
    protected $fillable = [
        'date','revenue','profit','total_order'
    ];
}
