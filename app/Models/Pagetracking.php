<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Pagetracking extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'pagetracking';
    protected $fillable = [
        'tracking_id','page','time','times'
    ];
    public function Usertraking(){
        return $this->belongsTo(Usertraking::class,'tracking_id','_id');
    }
}
