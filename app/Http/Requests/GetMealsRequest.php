<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetMealsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //  protected function prepareForValidation()
    // {
    //     if (isset($this->with)) {
    //       $this->with = explode(',', $this->with);
    //     }
    // }

    public function rules()
    {
        return [
            'lang' => [
              'required',
              Rule::in(['en', 'hrv', 'ita', 'deu']),
            ],
            'category' => [
              'max:4',
              Rule::in([1, 2, 3, "null"])
            ],
            'tags' => [
              'max:8'
            ],
            'with' => [
              'max:25'
            ]
        ];
    }
}
