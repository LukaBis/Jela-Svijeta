<?php

use App\Tag;

$number_of_tags = rand(1, App\Tag::count());

$all_tags = Tag::all();
$all_tags_ids = array();
$chosen_tags = array();

for ($i = 0; $i < Tag::count(); $i++)
{
    array_push($all_tags_ids, $all_tags[$i]->id);
}

for ($i = 0; $i < $number_of_tags; $i++)
{
    $index = rand(0, App\Tag::count() - 1);
    if ($all_tags_ids[$index] != null)
    {
      array_push($chosen_tags, $all_tags_ids[$index]);
      $all_tags_ids[$index] = null;
    }
}

 ?>
