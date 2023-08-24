<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PeopleInfo extends Model
{
	protected $connection = 'mongodb';
	protected $collection = 'peopleinfos';
	protected $fillable = ['link', 'description'];
	public $timestamps = false;
}
