<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticableIrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Eloquent implements Authenticatable
{
    use AuthenticableIrait;
    use Notifiable;

    protected $collection = 'users';
    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   
    protected $fillable = [
        'name',
        'email',
        'role',
        'address',
        'gender',
        'phone',
        'password',
        'status',
        'ip_adress',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
