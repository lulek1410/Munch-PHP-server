<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Alcohol;
use App\Models\Drink;
use App\Models\SoftDrink;
use Illuminate\Http\Request;

class MenuItemController extends BaseController
{
    public function __construct()
    {
        $model = null;
        switch (explode('/', Request::capture()->path())[0]) {
            case 'dishes':
                $model = new Dish();
                break;
            case 'alcohol':
                $model = new Alcohol();
                break;
            case 'drinks':
                $model = new Drink();
                break;
            case 'softDrinks':
                $model = new SoftDrink();
                break;
        }

        $validationRules = [
            'name' => 'required|string',
            'variants' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|string',
            'category' => 'nullable|string',
            'link' => 'nullable|string',
        ];

        $validationMessages = [
            'name.required' => 'Nazwa jest wymagana',
            'price.required' => 'Cena jest wymagana',
        ];
        parent::__construct($model, $validationRules, $validationMessages);
    }
}
