<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ContactInfo extends Model
{
	protected $connection = 'mongodb';
	protected $collection = 'contactinfos';
	protected $fillable = ['phoneNumber', 'email', 'adress', 'facebook', 'instagram', 'tiktok', 'openingHours'];
	public $timestamps = false;
}
