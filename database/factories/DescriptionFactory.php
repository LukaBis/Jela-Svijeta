<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description;
use App\DescriptionTranslation;
use Faker\Generator as Faker;

$factory->define(Description::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->afterCreating(Description::class, function ($desc, $faker) {

    include 'translations/description_translation.php';

    $faker = \Faker\Factory::create();
    $description = $descriptions[$faker->numberBetween(0, count($descriptions) - 1)];

    //description in english
    $title_translation = new DescriptionTranslation;
    $title_translation->description_id = $desc->id;
    $title_translation->locale = 'en';
    $title_translation->translation = $description;
    $title_translation->save();

    // description in croatian
    $title_translation = new DescriptionTranslation;
    $title_translation->description_id = $desc->id;
    $title_translation->locale = 'hrv';
    $title_translation->translation = $descriptions_croatian[$description];
    $title_translation->save();

    // description in italian
    $title_translation = new DescriptionTranslation;
    $title_translation->description_id = $desc->id;
    $title_translation->locale = 'ita';
    $title_translation->translation = $descriptions_italian[$description];
    $title_translation->save();

    // description in german
    $title_translation = new DescriptionTranslation;
    $title_translation->description_id = $desc->id;
    $title_translation->locale = 'deu';
    $title_translation->translation = $descriptions_german[$description];
    $title_translation->save();
});
