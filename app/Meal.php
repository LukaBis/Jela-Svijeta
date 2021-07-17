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

    public function status($diff_time)
    {
      // if diff_time is not set then we retrun created
      if (is_null($diff_time)) return 'created';

      $timestamps = array(
        'created' => strtotime($this->created_at),
        'modified' => strtotime($this->updated_at),
        'deleted' => strtotime($this->deleted_at)
      );

      arsort($timestamps);

      // we only take latest timestamp into consideration
      if ($diff_time < $timestamps[array_key_first($timestamps)]) return array_key_first($timestamps);

    }

    //testing purposes
    public function checkDifftime($diff_time)
    {
      $timestamps = array(
        'created' => strtotime($this->created_at),
        'modified' => strtotime($this->updated_at),
        'deleted' => strtotime($this->deleted_at)
      );

      arsort($timestamps);

      return ($diff_time < $timestamps[array_key_first($timestamps)]) ? array_key_first($timestamps) : false;
    }

    public function latestTimestamp()
    {
      $timestamps = array(
        'created' => strtotime($this->created_at),
        'modified' => strtotime($this->updated_at),
        'deleted' => strtotime($this->deleted_at)
      );

      arsort($timestamps);

      return array_key_first($timestamps) . ' ' . $timestamps[array_key_first($timestamps)];
    }

}
