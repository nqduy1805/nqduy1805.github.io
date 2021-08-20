<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comment extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'comment';
    protected $fillable = [
        'product_id','name','comment','comment_parent'
    ];
    public function Product(){
        return $this->belongsTo(Product::class,'product_id','_id');
    }
     public function Blog(){
        return $this->belongsTo(Blog::class,'product_id','_id');
    }
}
