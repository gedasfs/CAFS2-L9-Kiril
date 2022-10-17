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

Route::get('/', [Controllers\Products\ProductController::class, 'index']);

Route::prefix('/products')->name('products.')->group(function() {
    Route::get('/create', [Controllers\Products\ProductController::class, 'create'])->name('create');
    Route::get('/{product}/edit', [Controllers\Products\ProductController::class, 'edit'])->name('edit');
    Route::get('/{product}/show', [Controllers\Products\ProductController::class, 'show'])->name('show');
});
