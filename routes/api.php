<?php

use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::get('', ProductsController::class)->name('products.index');
    Route::get('{product:id}', [ProductsController::class, 'show'])->name('products.show');
});

