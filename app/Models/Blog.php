<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Blog extends Eloquent
{
 protected $connection = 'mongodb';
    protected $collection = 'blog';
    protected $fillable = [
        'blog_name','category_id','blog_image','blog_summary','blog_content','blog_author','blog_view'
    ];
      public function Category(){
        return $this->belongsTo(Category::class,'category_id','_id');
    }
 }
