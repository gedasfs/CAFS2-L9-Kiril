<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    // https://laravel.com/docs/9.x/eloquent#mass-assignment
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'identifier',
        'stock',
        'price'
    ];

    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-one-defining-the-inverse-of-the-relationship
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
