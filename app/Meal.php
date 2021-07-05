<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meal extends Model
{

    public function title()
    {
      return $this->belongsTo('App\Title');
    }


    public function description()
    {
      return $this->belongsTo('App\Description');
    }

    public function ingredients()
    {
      return $this->hasMany('App\Ingredient');
    }

    public function category()
    {

      if ($this->category_id != null)
      {
        return $this->belongsTo("App\Category");
      }

      return null;
    }

    public function tags()
    {
      return $this->belongsToMany(Tag::class);
    }

}
