<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;



Route::controller(ProductsController::class)->group(function(){
    Route::get('/products/create','create')->name('products.create');
    Route::post('/products','store')->name('products.store');
    Route::get('/','index')->name('products.index');
    Route::get('/products/{productid}/edit','edit')->name('products.edit');
    Route::put('/products/{productid}','update')->name('products.update');
    Route::delete('/products/{productid}','destroy')->name('products.delete');
    
});