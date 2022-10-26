<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\User;

class SaveOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => ['required', sprintf('exists:%s,id', User::class)],
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', sprintf('exists:%s,id', Product::class)],
            'products.*.count' => ['required', 'integer', 'min:1'],
        ];
    }
}
