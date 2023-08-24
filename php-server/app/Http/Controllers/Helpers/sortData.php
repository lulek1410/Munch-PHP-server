<?php

namespace App\Http\Controllers\Helpers;

function sortData($sort, &$data)
{
  $sortQuery = explode(',', trim($sort, '[]'));
  for ($i = 0; $i < count($sortQuery); $i++) {
    $sortQuery[$i] = str_replace('"', '', $sortQuery[$i]);
  }
  $sortBy = $sortQuery[0] === 'id' ? '_id' : $sortQuery[0];
  $sortDirection = $sortQuery[1] === 'ASC' ? 1 : -1;
  usort($data, function ($a, $b) use ($sortBy, $sortDirection) {
    if (isset($a[$sortBy]) && isset($b[$sortBy])) {
      $comparisonResult = strcmp((string) $a[$sortBy], (string) $b[$sortBy]);
      return $comparisonResult * $sortDirection;
    } else {
      return $sortDirection;
    }
  });
}
