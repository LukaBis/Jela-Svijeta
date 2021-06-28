<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Meal;
use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Meal::class, function (Faker $faker) {

    include 'category_generator.php';

    return [
      'title_id' => factory(App\Title::class)->create()->id,
      'description_id' => factory(App\Description::class)->create()->id,
      'category_id' => $category_id,
      'deleted_at' => now()
    ];
});

$factory->afterCreating(App\Meal::class, function ($meal, $faker) {
    // adding tags for meal
    include 'tags_generator.php';

    for ($i = 0; $i < count($chosen_tags); $i++) {
      $tag_meals = new App\Meal_tag;
      $tag_meals->tag_id = $chosen_tags[$i];
      $tag_meals->meal_id = $meal->id;
      $tag_meals->save();
    }

    // adding ingredients for meal
    $number_of_ingredients = rand(1, 10);

    for ($i = 0; $i < $number_of_ingredients; $i++)
    {
      $ingredient_id = factory(App\Ingredient::class)->create()->id;
      $ingredient = App\Ingredient::where('id', $ingredient_id)->update(['meal_id' => $meal->id]);
    }
});
