<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Validation\Rule;

class EventController extends BaseController
{
  protected $itemName;

  public function __construct()
  {
    $validationRules = [
      'name' => [
        'required',
        'string',
        Rule::unique('events'),
      ],
      'shortDescription' => [
        'required',
        'string',
      ],
      'description' => [
        'required',
        'string',
      ],
      'translation' => [
        'required',
        'string',
      ],
      'aditionalInfo' => [
        'nullable',
        'string',
      ],
      'link' => [
        'required',
        'string',
      ]
    ];
    $validationMessages = [
      'name.required' => 'Nazwa jest wymagana',
      'name.unique' => 'Podana nazwa jest już zajęta',
      'shortDescription.required' => 'Krótki opis jest wymagany',
      'description.required' => 'Opis jest wymagany',
      'translation.required' => 'Tłumaczenie jest wymagane',
      'link.required' => 'Link do zdjęcia jest wymagany'
    ];

    parent::__construct(new Event(), $validationRules, $validationMessages);
  }
}
