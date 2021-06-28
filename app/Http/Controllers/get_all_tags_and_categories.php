<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;

if ($lang == null)
{
  $translated_tags = array();
  $tags = Tag::all();

  foreach ($tags as $tag)
  {
    array_push($translated_tags, $tag->translate('en'));
  }

  $translated_categories = array();
  $categories = Category::all();

  foreach ($categories as $category)
  {
    array_push($translated_categories, $category->translate('en'));
  }

  return view('welcome', [
    'tags' => $translated_tags,
    'categories' => $translated_categories,
    'lang' => 'en'
  ]);
}
else
{
  $translated_tags = array();
  $tags = Tag::all();

  foreach ($tags as $tag)
  {
    array_push($translated_tags, $tag->translate($lang));
  }

  $translated_categories = array();
  $categories = Category::all();

  foreach ($categories as $category)
  {
    array_push($translated_categories, $category->translate($lang));
  }
}
 ?>
