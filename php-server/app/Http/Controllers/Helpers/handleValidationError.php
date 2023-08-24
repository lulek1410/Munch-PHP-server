<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Contracts\Routing\ResponseFactory;

function handleValidationError($responseFactory, $error)
{
  $errors = $error->errors();
  foreach ($errors as $field => $error) {
    $errors[$field] = $error[0];
  }
  return $responseFactory->json(['errors' => $errors], 422);
}
