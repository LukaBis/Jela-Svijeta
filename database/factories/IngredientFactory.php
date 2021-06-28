<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingredient;
use App\IngredientTranslation;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->afterCreating(Ingredient::class, function ($ing, $faker) {

    include 'translations/croatian_dish_translation.php';
    include 'translations/italian_dish_translation.php';
    include 'translations/german_dish_translation.php';

    $faker = \Faker\Factory::create();
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    $case = $faker->numberBetween(0, 2);

    switch($case)
    {
      case 0:
        $ingredient = $faker->dairyName();
        $ingredient_cro = $dairyNames_croatian[$ingredient];
        $ingredient_ita = $dairyNames_italian[$ingredient];
        $ingredient_deu = $dairyNames_german[$ingredient];
        break;
      case 1:
        $ingredient = $faker->meatName();
        $ingredient_cro = $meatNames_croatian[$ingredient];
        $ingredient_ita = $meatNames_italian[$ingredient];
        $ingredient_deu = $meatNames_german[$ingredient];
        break;
      case 2:
        $ingredient = $faker->sauceName();
        $ingredient_cro = $sauceNames_croatian[$ingredient];
        $ingredient_ita = $sauceNames_italian[$ingredient];
        $ingredient_deu = $sauceNames_german[$ingredient];
        break;
    }

    //ingredient in english
    $ingredient_translation = new IngredientTranslation;
    $ingredient_translation->ingredient_id = $ing->id;
    $ingredient_translation->locale = 'en';
    $ingredient_translation->translation = $ingredient;
    $ingredient_translation->save();

    // ingredient in croatian
    $ingredient_translation = new IngredientTranslation;
    $ingredient_translation->ingredient_id = $ing->id;
    $ingredient_translation->locale = 'hrv';
    $ingredient_translation->translation = $ingredient_cro;
    $ingredient_translation->save();

    // ingredient in italian
    $ingredient_translation = new IngredientTranslation;
    $ingredient_translation->ingredient_id = $ing->id;
    $ingredient_translation->locale = 'ita';
    $ingredient_translation->translation = $ingredient_ita;
    $ingredient_translation->save();

    // ingredient in german
    $ingredient_translation = new IngredientTranslation;
    $ingredient_translation->ingredient_id = $ing->id;
    $ingredient_translation->locale = 'deu';
    $ingredient_translation->translation = $ingredient_deu;
    $ingredient_translation->save();
});
