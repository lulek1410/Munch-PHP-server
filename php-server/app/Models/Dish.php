<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Dish extends MenuItem
{
    protected $collection = 'dishes';
}
