<?php

namespace App\Http\Resources;

class CheckWhichDataToReturn {

  public $category;
  public $tags;
  public $ingredients;

  function __construct($with) {
    $this->with = $this->convertToArray($with);
    $this->category = false;
    $this->tags = false;
    $this->ingredients = false;
  }

  private function convertToArray($string) {
    $with_array = explode(',', $string);
    (count($with_array) == 0) ? $with = [$string] : $with = $with_array;
    return $with;
  }

  public function setAttributes() {
    foreach ($this->with as $attribute) {
      switch ($attribute) {
        case 'tags':
          $this->tags = true;
          break;
        case 'category':
          $this->category = true;
          break;
        case 'ingredients':
          $this->ingredients = true;
          break;
      }
    }
  }

}
