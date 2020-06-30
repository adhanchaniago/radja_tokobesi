<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'poto', 'avatar'
    ];
    public function order()
    {
        return $this->hasMany(Order::class, 'created_by');
    }
    public function social()
    {
    	return $this->hasMany(Social::class);
    }
}
