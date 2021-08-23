<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Usertraking extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'usertraking';
    protected $fillable = [
        'ip_adress','date_visit','time','date',
    ];
}
