<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-one-defining-the-inverse-of-the-relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // https://laravel.com/docs/9.x/eloquent-relationships#many-to-many
    // https://laravel.com/docs/9.x/eloquent-relationships#retrieving-intermediate-table-columns
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products')->withPivot('count');
    }
}
