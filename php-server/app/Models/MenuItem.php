<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class MenuItem extends Model
{
  protected $connection = 'mongodb';
  protected $fillable = ['name', 'variants', 'description', 'price', 'category', 'link'];
  public $timestamps = false;
}
