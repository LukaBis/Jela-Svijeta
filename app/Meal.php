<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meal extends Model
{
    public function title($lang)
    {
      $title = $this->belongsTo('App\Title')->get()[0]->translate($lang);
      return $title;
    }

    public function description($lang)
    {
      $title = $this->belongsTo('App\Description')->get()[0]->translate($lang);
      return $title;
    }

    public function ingredients($lang)
    {
      $ingredients = $this->hasMany('App\Ingredient')->get();
      $ingredients_translated = array();

      foreach ($ingredients as $ingredient)
      {
        array_push($ingredients_translated, $ingredient->translate($lang));
      }

      return $ingredients_translated;
    }

    public function category($lang)
    {

      if ($this->category_id != null)
      {
        $category = DB::table("categories")->where("id", "=", $this->category_id)->get()[0];

        $category_translation = DB::table("category_translations")->where([
          ["category_id", "=", $category->id],
          ["locale", "=", $lang]
        ])->get();

        if (count($category_translation)) {
          return $category_translation[0]->translation;
        }
        else {
          return null;
        }
      }

      return null;
    }

    public function tags($lang)
    {
      $tags = $this->belongsToMany('App\Tag')->get();
      $tags_translated = array();

      foreach ($tags as $tag)
      {
        array_push($tags_translated, $tag->translate($lang));
      }

      return $tags_translated;
    }

    public function is_tagged($tag_slug)
    {
      $tags = $this->belongsToMany('App\Tag')->get();

      foreach ($tags as $tag)
      {
        if ($tag->slug == $tag_slug)
        {
          return 1;
        }
      }

      return 0;
    }

    public function is_in_category($category_slug)
    {
      // usporedit category_id od meal i id od category
      $category = $category = DB::table("categories")->where("slug", "=", $category_slug)->get()[0];

      return $this->category_id == $category->id;
    }
}
