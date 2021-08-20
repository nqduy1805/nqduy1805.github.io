<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'categories';
    protected $fillable = [
        'category_name','category_parent','category_status',
    ];
          public function Category(){
        return $this->belongsTo(Category::class,'category_parent','_id');
    }
}
