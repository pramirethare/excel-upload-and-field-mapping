<?php

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

Route::prefix('product')->group(function() {
    Route::resource('/',ProductController::class);
    Route::get('/map',[Modules\Product\Http\Controllers\ProductController::class,'map'])->name('product.map');
    Route::post('/import',[Modules\Product\Http\Controllers\ProductController::class,'import'])->name('product.import');
    Route::get('/download',[Modules\Product\Http\Controllers\ProductController::class,'download'])->name('product.download');
});