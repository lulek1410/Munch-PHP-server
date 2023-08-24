<?php

namespace App\Http\Controllers;

use App\Models\PeopleInfo;

class PeopleInfoController extends BaseController
{
  public function __construct()
  {
    $validationRules = [
      'link' => 'required|string',
      'description' => 'required|string',
    ];

    $validationMessages = [
      'link.required' => 'Link do zdjęcia jest wymagany',
      'description.required' => 'Opis jest wymagany',
    ];
    parent::__construct(new PeopleInfo(), $validationRules, $validationMessages);
  }
}
