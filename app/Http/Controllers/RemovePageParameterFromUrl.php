<?php

namespace App\Http\Controllers;

class RemovePageParameterFromUrl {

  public static function remove($url, $page)
  {
    return str_replace("&page=" . $page, "", $url);
  }

}
