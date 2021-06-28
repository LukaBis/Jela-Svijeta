<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitleTranslation extends Model
{
    //protected $fillable = ['translation', 'title_id', 'language_id'];
    protected $guarded = [];
    protected $table = 'title_translations';
}
