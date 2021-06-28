<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Tag extends Model  implements TranslatableContract
{
    use Translatable;

     public $translatedAttributes = ['translation'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($tag) {

            $tag->slug = $tag->createSlug($tag->id);

            $tag->save();
        });
    }

    private function createSlug($id)
    {
        $slug = 'tag-' . $id;
        return $slug;
    }
}
