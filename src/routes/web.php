<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [Controllers\Products\ProductController::class, 'index'])->name('products.index');

Route::prefix('/products')->name('products.')->group(function() {
    Route::get('/create', [Controllers\Products\ProductController::class, 'create'])->name('create');
    Route::post('/store/v1', [Controllers\Products\ProductController::class, 'storeV1'])->name('store.v1');
    Route::post('/store/v2', [Controllers\Products\ProductController::class, 'storeV2'])->name('store.v2');
    Route::post('/store/v3', [Controllers\Products\ProductController::class, 'storeV3'])->name('store.v3');
    Route::post('/store/v4', [Controllers\Products\ProductController::class, 'storeV4'])->name('store.v4');
    Route::post('/store/v5', [Controllers\Products\ProductController::class, 'storeV5'])->name('store.v5');
    
    Route::get('/{product}/edit', [Controllers\Products\ProductController::class, 'edit'])->name('edit');
    Route::post('/{product}/update', [Controllers\Products\ProductController::class, 'update'])->name('update');
    
    Route::get('/{product}/show', [Controllers\Products\ProductController::class, 'show'])->name('show');
});
