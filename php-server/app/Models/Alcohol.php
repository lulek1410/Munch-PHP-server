<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Alcohol extends MenuItem
{
    protected $collection = 'alcohols';
}
