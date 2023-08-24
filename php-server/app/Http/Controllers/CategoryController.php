<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\DishCategory;
use App\Models\AlcoholCategory;
use App\Models\DrinkCategory;
use App\Models\SoftDrinkCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends BaseController
{
  public function __construct()
  {
    $model = null;
    switch (explode('/', Request::capture()->path())[0]) {
      case 'dishes':
        $model = new DishCategory();
        break;
      case 'alcohol':
        $model = new AlcoholCategory();
        break;
      case 'drinks':
        $model = new DrinkCategory();
        break;
      case 'softDrinks':
        $model = new SoftDrinkCategory();
        break;
    }
    $unique = $model->getCollectionName();
    $validationRules = [
      'name' => [
        'required',
        'string',
        Rule::unique($unique),
      ],
      'priority' => [
        'required',
        function ($attribute, $value, $fail) {
          if (gettype($value) !== 'integer') {
            $fail('The $attribute must be a valid integer.');
          }
        },
        Rule::unique($unique),
      ]
    ];
    $validationMessages = [
      'name.required' => 'Nazwa jest wymagana',
      'priority.required' => 'Priorytet jest wymagany',
      'name.unique' => 'Podana nazwa jest już zajęta',
      'priority.unique' => 'Podany priorytet jest już zajęty',
    ];

    parent::__construct($model, $validationRules, $validationMessages);
  }

  function show(Request $request)
  {
    try {
      $categories = $this->model::all()->toArray();
      if ($request->has('sort')) {
        $sort = $request->query('sort');
        $sortQuery = explode(',', trim($sort, '[]'));
        for ($i = 0; $i < count($sortQuery); $i++) {
          $sortQuery[$i] = str_replace('"', '', $sortQuery[$i]);
        }
        $sortBy = $sortQuery[0] === 'id' ? '_id' : $sortQuery[0];
        $sortDirection = $sortQuery[1] === 'ASC' ? 1 : -1;
        if ($sortBy !== 'priority') {
          usort($categories, function ($a, $b) use ($sortBy, $sortDirection) {
            return strcasecmp($a[$sortBy], $b[$sortBy]) * $sortDirection;
          });
        } else {
          usort($categories, function ($a, $b) use ($sortBy, $sortDirection) {
            return ($a[$sortBy] - $b[$sortBy]) * $sortDirection;
          });
        }
      }
      $size = count($categories);
      return response()
        ->json($categories, 200)
        ->withHeaders([
          'Content-Range' => 'pages 0/{$size}/{$size}'
        ]);
    } catch (Exception $e) {
      echo $e->getMessage() . '\n';
      return response()->json('Could not GET ' . $this->path, 400);
    }
  }
}
