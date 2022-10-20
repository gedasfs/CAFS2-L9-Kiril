<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // https://laravel.com/docs/9.x/eloquent#mass-assignment
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'identifier'
    ];
}
