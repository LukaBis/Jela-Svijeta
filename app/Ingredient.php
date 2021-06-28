<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ingredient extends Model  implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['translation'];
    
    protected static function boot()
    {
        parent::boot();

        static::created(function ($ingredient) {

            $ingredient->slug = $ingredient->createSlug($ingredient->id);

            $ingredient->save();
        });
    }

    private function createSlug($id)
    {
        $slug = 'ingredient-' . $id;
        return $slug;
    }
}
