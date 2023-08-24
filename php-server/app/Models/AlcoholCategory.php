<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class AlcoholCategory extends Model
{
  protected $connection = 'mongodb';
  protected $collection = 'alcoholcategories';
  protected $fillable = ['name', 'priority'];
  public $timestamps = false;
}
