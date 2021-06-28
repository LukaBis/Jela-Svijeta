<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Title;
use App\TitleTranslation;
use Faker\Generator as Faker;


$factory->define(Title::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->afterCreating(Title::class, function ($title, $faker) {

    include 'translations/croatian_dish_translation.php';
    include 'translations/italian_dish_translation.php';
    include 'translations/german_dish_translation.php';

    $faker = \Faker\Factory::create();
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    $food_name = $faker->foodName();

    //title in english
    $title_translation = new TitleTranslation;
    $title_translation->title_id = $title->id;
    $title_translation->locale = 'en';
    $title_translation->translation = $food_name;
    $title_translation->save();

    // title in croatian
    $title_translation = new TitleTranslation;
    $title_translation->title_id = $title->id;
    $title_translation->locale = 'hrv';
    $title_translation->translation = $foodNames_croatian[$food_name];
    $title_translation->save();

    // title in italian
    $title_translation = new TitleTranslation;
    $title_translation->title_id = $title->id;
    $title_translation->locale = 'ita';
    $title_translation->translation = $foodNames_italian[$food_name];
    $title_translation->save();

    // title in german
    $title_translation = new TitleTranslation;
    $title_translation->title_id = $title->id;
    $title_translation->locale = 'deu';
    $title_translation->translation = $foodNames_german[$food_name];
    $title_translation->save();
});
