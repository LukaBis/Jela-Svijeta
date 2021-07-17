<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Title;
use App\Description;
use App\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Tag as TagResource;
use App\Http\Resources\Ingredient as IngredientResource;

class Meal extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $check = new CheckWhichDataToReturn($request->input('with'));
      $check->setAttributes();

      return [
          'id' => $this->id,
          'title' => $this->title()->get()[0]->translate($request->lang)->translation,
          'description' => $this->description()->get()[0]->translate($request->lang)->translation,
          'status' => $this->status($request->diff_time),
          'category' => $this->when($check->category, ($this->category_id != null) ?
          CategoryResource::collection($this->category()->get()) : null),
          'tags' => $this->when($check->tags, TagResource::collection($this->tags()->get())),
          'ingredients' => $this->when($check->ingredients, IngredientResource::collection($this->ingredients()->get())),
      ];
    }
}
