<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Title extends Model implements TranslatableContract
{

    use Translatable;
    public $translatedAttributes = ['translation'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($title) {

            $title->slug = $title->createSlug($title->id);

            $title->save();
        });
    }

    private function createSlug($id)
    {
        $slug = 'title-' . $id;
        return $slug;
    }
}
