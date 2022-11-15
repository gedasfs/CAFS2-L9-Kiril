<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
	const ORDERING_VALUES = [
        'created_at' => 'Newest first',
        'name:asc'   => 'Name Accessing',
        'name:desc'  => 'Name Descending',
        'price:asc'  => 'Price Accessing',
        'price:desc' => 'Price Descending',
        'identifier:asc' => 'Identifier Accessing',
        'identifier:desc' => 'Identifier Descending',
    ];

    const ORDERING_DEFAULT_VALUE = 'created_at';

    public function get(array $filters = [])
    {
        $productQuery = Product::query()->where('is_active', true);

        $categoryId = data_get($filters, 'category_id');

        if ($categoryId && is_numeric($categoryId)) {
            $productQuery->where('category_id', $categoryId);
        }

        $search = data_get($filters, 'search');

        if ($search) {
            $likeValue = '%' . $search . '%';

            $productQuery->where(function($query) use($likeValue) {
                $query->where('name', 'LIKE', $likeValue);
                $query->orWhere('description', 'LIKE', $likeValue);
            });
        }

        $orderBy = data_get($filters, 'order_by');
        $orderBy = array_key_exists($orderBy, self::ORDERING_VALUES) ? $orderBy : self::ORDERING_DEFAULT_VALUE;
        $orderBy = explode(':', $orderBy);

        $orderByColumn = $orderBy[0];
        $orderByDirection = $orderBy[1] ?? 'desc';

        $productQuery->orderBy($orderByColumn, $orderByDirection);

        $products = $productQuery->get();

        return $products;
    }

    public function save(array $data, Product $product = null): Product
    {
        if ($product == null) {
            $product = new Product();
        }

        $product->fill($data);

        $product->is_active = true;

        $product->save();

        return $product;
    }
}