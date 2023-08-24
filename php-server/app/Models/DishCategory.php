<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class DishCategory extends Model
{
  protected $connection = 'mongodb';
  protected $collection = 'dishcategories';
  protected $fillable = ['name', 'priority'];
  public $timestamps = false;
}
