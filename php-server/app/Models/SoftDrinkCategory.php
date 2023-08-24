<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class SoftDrinkCategory extends Model
{
	protected $connection = 'mongodb';
	protected $collection = 'softdrinkcategories';
	protected $fillable = ['name', 'priority'];
	public $timestamps = false;
}
