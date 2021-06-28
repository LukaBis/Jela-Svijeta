<?php

use App\Category;
// use Faker\Generator as Faker;

$categories_ids = [];
$numOfCategories = Category::count();
$categories = Category::all();

// $faker = \Faker\Factory::create();
// $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

for ($i = 0; $i < $numOfCategories; $i++)
{
    array_push($categories_ids, $categories[$i]->id);
}

array_push($categories_ids, null);

$n = rand(0, $numOfCategories);
$category_id = $categories_ids[$n];

?>
