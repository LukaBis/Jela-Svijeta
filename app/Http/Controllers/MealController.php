<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Meal as MealResource;
use Illuminate\Http\Request;
use App\Meal;
use \App\Http\Requests\GetMealsRequest;
use Carbon\Carbon;

class MealController extends Controller
{
    public function meals(GetMealsRequest $request)
    {
        $lang = $request->input('lang');
        $diff_time = $request->input('diff_time');
        $per_page = (int)$request->input('per_page');

        // category will be "null" if null is in query and null when category is not in query
        $category = $request->input('category');
        $tags = $request->input('tags');

        $meals = Meal::when($category, function ($query, $category) {
          if ($category == "!null") return $query->where('category_id', '!=', null);
          if ($category == "null") return $query->where('category_id', null);
          return $query->where('category_id', $category);
        })
        ->when($tags, function ($query, $tags) {
          return $query->whereHas('tags', function(Builder $query) use($tags) {
            $query->whereIn('tag_id', $tags);
          }, '=', count($tags));
        })
        ->when($diff_time, function($query, $diff_time) {
          return $query->where(function ($query) use($diff_time) {
            $query->where('created_at', '>', Carbon::parse((int)$diff_time))
                  ->orWhere('updated_at', '>', Carbon::parse((int)$diff_time))
                  ->orWhere('deleted_at', '>', Carbon::parse((int)$diff_time));
          });
        })
        ->paginate($per_page);

        $meals->withPath(
          RemovePageParameterFromUrl::remove(url()->full(), $request->input('page'))
        );

        return MealResource::collection($meals);
    }

}
