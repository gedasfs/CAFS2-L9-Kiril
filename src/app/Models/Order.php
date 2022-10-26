<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-one-defining-the-inverse-of-the-relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return [1,2,3];
    }
}
