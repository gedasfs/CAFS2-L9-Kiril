<?php

namespace App\Http\Requests\Api\V1\Products;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\ProductCategory;

class SaveProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:5|max:255|string',
            'description' => ['required', 'min:5', 'max:1000', 'string'],
            'category_id' => ['required', sprintf('exists:%s,id', ProductCategory::class)],
            'identifier' => ['required', sprintf('unique:%s,identifier,%d', Product::class, $this->product?->id)]
        ];

        return $rules;
    }
}
