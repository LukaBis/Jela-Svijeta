<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;

class HomeController extends Controller
{
    public function index($lang = null)
    {

      include('get_all_tags_and_categories.php');

      return view('welcome', [
        'tags' => $translated_tags,
        'categories' => $translated_categories,
        'lang' => $lang
      ]);

    }
}
