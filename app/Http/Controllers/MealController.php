<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Meal as MealResource;
use Illuminate\Http\Request;
use App\Meal;
use \App\Http\Requests\GetMealsRequest;

class MealController extends Controller
{
    public function meals(GetMealsRequest $request)
    {
        $lang = $request->input('lang');

        // category will be "null" if null is in query and null when category is not in query
        $category = $request->input('category');

        // check if there is only one element, then there is no comma
        $tags_array = explode(',', $request->input('tags'));
        (count($tags_array) == 0) ? $tags = $request->input('tags') : $tags = $tags_array;

        if ((is_numeric($category) || $category == "null") && strlen($tags[0]) == 0) {
          // category given and no tags given
          if ($category == "null") {
            $meals = Meal::where('category_id', null)->get();
          } else {
            $meals = Meal::where('category_id', $category)->get();
          }
        } elseif ($category == null && strlen($tags[0]) != 0) {
          // no categroy given, just tags
          $meals = Meal::whereHas('tags', function(Builder $query) use($tags) {
            $query->whereIn('tag_id', $tags);
          }, '=', count($tags))->get();
        } elseif ((is_numeric($category) || $category == "null") && strlen($tags[0]) != 0) {
          // category and tags given
          if ($category == "null") {
            $meals = Meal::where('category_id', null)->whereHas('tags', function(Builder $query) use($tags) {
              $query->whereIn('tag_id', $tags);
            }, '=', count($tags))->get();
          } else {
            $meals = Meal::where('category_id', $category)->whereHas('tags', function(Builder $query) use($tags) {
              $query->whereIn('tag_id', $tags);
            }, '=', count($tags))->get();
          }
        } else {
          // no category and no tags given
          $meals = Meal::all();
        }

        return MealResource::collection($meals);
    }

}
