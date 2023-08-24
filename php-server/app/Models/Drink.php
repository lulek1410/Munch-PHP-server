<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Drink extends MenuItem
{
    protected $collection = 'drinks';
}
