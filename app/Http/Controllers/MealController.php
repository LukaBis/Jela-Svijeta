<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;

class MealController extends Controller
{
    public function index(Request $request)
    {
      $to_return_meals = array();

      $lang = $request->language;

      include 'get_all_tags_and_categories.php';

      if ($request->filter == "none")
      {
        $meals = Meal::all();
        foreach ($meals as $meal)
        {
          $title = $meal->title($request->language);
          $description = $meal->description($request->language);
          ($request->ingredients == "true") ? $ingredients = $meal->ingredients($request->language) : $ingredients = null;
          ($request->category == "true") ? $category = $meal->category($request->language) : $category = null;
          ($request->tags == "true") ? $tags = $meal->tags($request->language) : $tags = null;

          array_push(
            $to_return_meals,
            [
              "title" => $title,
              "description" => $description,
              "ingredients" => $ingredients,
              "category" => $category,
              "tags" => $tags,
            ]
          );
        }
      }
      else if (substr($request->filter, 0, 3) == "tag")
      {
        $tag_slug = substr($request->filter, 4);
        $tagged_meals = array();
        $to_return_meals = array();

        $all_meals = Meal::all();

        foreach ($all_meals as $meal)
        {
          if ($meal->is_tagged($tag_slug))
          {
            array_push($tagged_meals, $meal);
          }
        }

        foreach ($tagged_meals as $meal)
        {
          $title = $meal->title($request->language);
          $description = $meal->description($request->language);
          ($request->ingredients == "true") ? $ingredients = $meal->ingredients($request->language) : $ingredients = null;
          ($request->category == "true") ? $category = $meal->category($request->language) : $category = null;
          ($request->tags == "true") ? $tags = $meal->tags($request->language) : $tags = null;

          array_push(
            $to_return_meals,
            [
              "title" => $title,
              "description" => $description,
              "ingredients" => $ingredients,
              "category" => $category,
              "tags" => $tags,
            ]
          );
        }

      }
      else if (substr($request->filter, 0, 8) == "category")
      {
        $category_slug = substr($request->filter, 9);
        $category_meals = array();
        $to_return_meals = array();

        $all_meals = Meal::all();

        foreach ($all_meals as $meal)
        {
          if ($meal->is_in_category($category_slug))
          {
            array_push($category_meals, $meal);
          }
        }

        foreach ($category_meals as $meal)
        {
          $title = $meal->title($request->language);
          $description = $meal->description($request->language);
          ($request->ingredients == "true") ? $ingredients = $meal->ingredients($request->language) : $ingredients = null;
          ($request->category == "true") ? $category = $meal->category($request->language) : $category = null;
          ($request->tags == "true") ? $tags = $meal->tags($request->language) : $tags = null;

          array_push(
            $to_return_meals,
            [
              "title" => $title,
              "description" => $description,
              "ingredients" => $ingredients,
              "category" => $category,
              "tags" => $tags,
            ]
          );
        }

      }

      return view('welcome', [
        "meals" => $to_return_meals,
        "lang" => $request->language,
        'tags' => $translated_tags,
        'categories' => $translated_categories
      ]);

    }
}
