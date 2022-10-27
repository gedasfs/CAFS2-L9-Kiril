<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => new ProductCategoryResource($this->category),
            'stock' => $this->stock,
            'name' => $this->name,
            'description' => $this->description,
            'identifier' => $this->identifier,
            'price' =>  $this->price,
            'count' => $this->when($this->pivot, function() {
                return $this->pivot->count;
            })
        ];
    }

    public function __toString()
    {
        return $this->toJson();
    }
}