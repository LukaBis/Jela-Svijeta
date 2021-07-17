<?php

namespace App\Http\Requests;

class ConvertToArrayForValidation {

  // accepts collection of models where only one column is selected
  // returns an array of values of that column
  public static function getArray($collection, $appendNull = false)
  {
    $mat = $collection->toArray();

    $arr = array();

    foreach ($mat as $key => $value) {
      array_push($arr, array_values($value)[0]);
    }

    if ($appendNull) {
      array_push($arr, "null");
      array_push($arr, "!null");
    }

    return $arr;
  }

}
