<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class DrinkCategory extends Model
{
  protected $connection = 'mongodb';
  protected $collection = 'drinkcategories';
  protected $fillable = ['name', 'priority'];
  public $timestamps = false;
}
