<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Event extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'events';
    protected $fillable = ['name', 'shortDescription', 'description', 'translation', 'aditionalInfo', 'link', 'postDate'];
    public $timestamps = false;
}
