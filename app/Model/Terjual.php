<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Terjual extends Model
{
	protected $table    = 'terjual';
	protected $fillable = ['name', 'cabang', 'terjual', 'satuan'];
}
