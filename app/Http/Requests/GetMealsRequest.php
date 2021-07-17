<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Language;
use App\Category;
use App\Tag;

class GetMealsRequest extends FormRequest
{

    public function attributes()
    {
      return [
          'lang' => 'language',
      ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tags' => explode(',',$this->tags),
            'with' => explode(',',$this->with),
        ]);

        // if tags are not given i request, set to false
        (!$this->tags[0]) ? $this->merge(['tags' => false ]) : '';
    }

    public function rules()
    {
        return [
            'lang' => [
              'required',
              Rule::in(ConvertToArrayForValidation::getArray(
                Language::select('iso')->get()
              )),
            ],
            'category' => [
              Rule::in(ConvertToArrayForValidation::getArray(
                Category::select('id')->get(), true
              ))
            ],
            'tags.*' => [
              Rule::in(ConvertToArrayForValidation::getArray(
                Tag::select('id')->get()
              )),
              'distinct'
            ],
            'with.*' => [
              Rule::in(['tags', 'category', 'ingredients']),
              'distinct'
            ],
            //253402300800 is max unix timestamp for 64-bit OS system
            'diff_time' => ['gt:0', 'numeric', 'lt:253402300800'],
            'per_page' => 'gt:0|numeric',
            'page' => 'numeric'
        ];
    }
}
