<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\PeopleInfoController;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Alcohol;
use App\Models\AlcoholCategory;
use App\Models\Drink;
use App\Models\DrinkCategory;
use App\Models\SoftDrink;
use App\Models\SoftDrinkCategory;
use App\Models\ContactInfo;
use App\Models\Event;
use App\Models\PeopleInfo;

Route::controller(CategoryController::class)->group(function () {
  Route::get('/dishes/categories', 'show');
  Route::get('/dishes/categories/{id}', 'showSingle');
  Route::get('/alcohol/categories', 'show');
  Route::get('/alcohol/categories/{id}', 'showSingle');
  Route::get('/drinks/categories', 'show');
  Route::get('/drinks/categories/{id}', 'showSingle');
  Route::get('/softDrinks/categories', 'show');
  Route::get('/softDrinks/categories/{id}', 'showSingle');
});

Route::middleware(['auth'])->group(function () {
  Route::controller(CategoryController::class)->group(function () {
    Route::post('/dishes/categories', 'store');
    Route::put('/dishes/categories/{id}', 'update');
    Route::delete('/dishes/categories/{id}', 'deleteOne');
    Route::post('/alcohol/categories', 'store');
    Route::put('/alcohol/categories/{id}', 'update');
    Route::delete('/alcohol/categories/{id}', 'deleteOne');
    Route::post('/drinks/categories', 'store');
    Route::put('/drinks/categories/{id}', 'update');
    Route::delete('/drinks/categories/{id}', 'deleteOne');
    Route::post('/softDrinks/categories', 'store');
    Route::put('/softDrinks/categories/{id}', 'update');
    Route::delete('/softDrinks/categories/{id}', 'deleteOne');
  });
});

Route::controller(MenuItemController::class)->group(function () {
  Route::get('/dishes', 'show');
  Route::get('/dishes/{id}', 'showSingle');
  Route::get('/alcohol', 'show');
  Route::get('/alcohol/{id}', 'showSingle');
  Route::get('/drinks', 'show');
  Route::get('/drinks/{id}', 'showSingle');
  Route::get('/softDrinks', 'show');
  Route::get('/softDrinks/{id}', 'showSingle');
});

Route::middleware(['auth'])->group(function () {
  Route::controller(MenuItemController::class)->group(function () {
    Route::post('/dishes', 'store');
    Route::put('/dishes/{id}', 'update');
    Route::delete('/dishes/{id}', 'deleteOne');
    Route::post('/alcohol', 'store');
    Route::put('/alcohol/{id}', 'update');
    Route::delete('/alcohol/{id}', 'deleteOne');
    Route::post('/drinks', 'store');
    Route::put('/drinks/{id}', 'update');
    Route::delete('/drinks/{id}', 'deleteOne');
    Route::post('/softDrinks', 'store');
    Route::put('/softDrinks/{id}', 'update');
    Route::delete('/softDrinks/{id}', 'deleteOne');
  });
});

Route::controller(EventController::class)->group(function () {
  Route::get('/events', 'show');
  Route::get('/events/{id}', 'showSingle');
});

Route::middleware(['auth'])->group(function () {
  Route::controller(EventController::class)->group(function () {
    Route::post('/events', 'store');
    Route::put('/events/{id}', 'update');
    Route::delete('/events/{id}', 'deleteOne');
  });
});

Route::controller(ContactInfoController::class)->group(function () {
  Route::get('/contactInfo', 'show');
  Route::get('/contactInfo/{id}', 'showSingle');
});

Route::middleware(['auth'])->group(function () {
  Route::controller(ContactInfoController::class)->group(function () {
    Route::put('/contactInfo/{id}', 'update');
  });
});

Route::controller(PeopleInfoController::class)->group(function () {
  Route::get('/peopleInfo', 'show');
  Route::get('/peopleInfo/{id}', 'showSingle');
});

Route::middleware(['auth'])->group(function () {
  Route::controller(PeopleInfoController::class)->group(function () {
    Route::put('/peopleInfo/{id}', 'update');
  });
});

Route::get('/all', function () {
  $dishCategories =  DishCategory::all()->toArray();
  $dishes =  (Dish::all()->toArray());

  $alcoholCategories =  (AlcoholCategory::all()->toArray());
  $alcohol =  (Alcohol::all()->toArray());

  $drinkCategories =  (DrinkCategory::all()->toArray());
  $drinks =  (Drink::all()->toArray());

  $softDrinkCategories =  (SoftDrinkCategory::all()->toArray());
  $softDrinks =  (SoftDrink::all()->toArray());

  $contactInfo =  (ContactInfo::all()->toArray());
  $events =  (Event::all()->toArray());
  $peopleInfo =  (PeopleInfo::all()->toArray());

  return response()->json([
    'food' => [
      'dishes' => ['categories' => $dishCategories, 'elements' => $dishes],
      'alcohol' => ['categories' => $alcoholCategories, 'elements' => $alcohol],
      'drinks' => ['categories' => $drinkCategories, 'elements' => $drinks],
      'softDrinks' => ['categories' => $softDrinkCategories, 'elements' => $softDrinks],
    ],
    'contactInfo' => $contactInfo,
    'events' => $events,
    'peopleInfo' => $peopleInfo,
  ], 200);
});
