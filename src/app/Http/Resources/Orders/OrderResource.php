<?php

namespace App\Http\Resources\Orders;

use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Products\ProductResource;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'products' => ProductResource::collection($this->products),
        ];
    }
}
