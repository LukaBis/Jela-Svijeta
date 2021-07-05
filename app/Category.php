<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model  implements TranslatableContract
{
  use Translatable;

  public $translatedAttributes = ['translation'];
  protected $hidden = ['translation'];

  protected static function boot()
  {
      parent::boot();

      static::created(function ($category) {

          $category->slug = $category->createSlug($category->id);

          $category->save();
      });
  }

  private function createSlug($id)
  {
      $slug = 'category-' . $id;
      return $slug;
  }
}
