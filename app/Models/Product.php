<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'product';
    protected $fillable = [
        'product_name','category_id','product_price','product_quantity','product_info','product_introduce','product_image','product_image1','product_image2','product_image3','product_sale','product_size','product_view',
    ];
      public function Category(){
        return $this->belongsTo(Category::class,'category_id','_id');
    }
}
