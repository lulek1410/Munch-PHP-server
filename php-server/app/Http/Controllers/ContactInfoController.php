<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends BaseController
{
  public function __construct()
  {
    $validationRules = [
      'phoneNumber' => 'required|string',
      'email' => 'required|string',
      'adress' => 'required|string',
      'facebook' => 'nullable|string',
      'instagram' => 'nullable|string',
      'tiktok' => 'nullable|string',
      'openingHours.*.day' => 'required|string',
      'openingHours.*.time' => 'required|string',
    ];

    $validationMessages = [
      'phoneNumber.required' => 'Numer telefonu jest wymagany',
      'email.required' => 'Email jest wymagany',
      'adress.required' => 'Adres jest wymagany',
      'email.required' => 'Email jest wymagany',
      'openingHours.*.day.required' => 'Dzień jest wymagany dla każdego elementu',
      'openingHours.*.time.required' => 'Czas jest wymagany dla każdego elementu',
    ];
    parent::__construct(new ContactInfo(), $validationRules, $validationMessages);
  }

  function show(Request $request)
  {
    try {
      $contactInfo = ContactInfo::all()->toArray();
      if ($request->has('sort')) {
        $sort = $request->query('sort');
        $sortQuery = explode(',', trim($sort, '[]'));
        for ($i = 0; $i < count($sortQuery); $i++) {
          $sortQuery[$i] = str_replace('"', '', $sortQuery[$i]);
        }
        $sortBy = $sortQuery[0] === 'id' ? '_id' : $sortQuery[0];
        $sortDirection = $sortQuery[1] === 'ASC' ? 1 : -1;
        if ($sortBy !== 'openingHours') {
          usort($contactInfo, function ($a, $b) use ($sortBy, $sortDirection) {
            return isset($a[$sortBy])
              ? strcasecmp($a[$sortBy], $b[$sortBy]) * $sortDirection
              : $sortDirection;
          });
        } else {
          usort($contactInfo, function ($a, $b) use ($sortBy, $sortDirection) {
            return (count($a[$sortBy]) - count($b[$sortBy])) * $sortDirection;
          });
        }
      }
      $size = count($contactInfo);
      return response()
        ->json($contactInfo, 200)
        ->withHeaders([
          'Content-Range' => 'pages 0/{$size}/{$size}'
        ]);
    } catch (Exception $e) {
      echo $e->getMessage() . '\n';
      return response()->json('Could not GET /drinks', 400);
    }
  }
}
