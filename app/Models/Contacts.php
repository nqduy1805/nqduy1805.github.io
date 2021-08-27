<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Contacts extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'contacts';
    protected $fillable = [
        'contact_name', 'contact_email', 'contact_phone', 'contact_message'
    ];
    
}
