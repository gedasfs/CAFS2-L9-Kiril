<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1 as ApiV1Controllers;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::get('/categories', [ApiV1Controllers\Products\CategoryController::class, 'index']);
    
    Route::prefix('products')->group(function() {
        Route::get('/', [ApiV1Controllers\Products\ProductController::class, 'index']);
        Route::get('/{product}', [ApiV1Controllers\Products\ProductController::class, 'find']);
        Route::post('/', [ApiV1Controllers\Products\ProductController::class, 'save']);
        Route::patch('/{product}', [ApiV1Controllers\Products\ProductController::class, 'save']);
    });
});