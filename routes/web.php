<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShopController;
use App\Http\Controllers\LocaleController;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need 'view backend' permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    includeRouteFiles(__DIR__.'/backend/');
});

//shop routes
Route::group(['prefix'=>'shops','middleware'=>'auth','as'=>'shops.'], function(){
    Route::get('/', [ShopController::class,'index'])->name('index');
    Route::get('/create', [ShopController::class,'create'])->name('create');
    Route::post('/store', [ShopController::class,'store'])->name('store');
    Route::get('/show/{id}', [ShopController::class,'show'])->name('show');
    Route::get('/{id}/edit', [ShopController::class,'edit'])->name('edit');
    Route::get('/destroy/{shops}', [ShopController::class,'destroy'])->name('destroy');
    Route::put('/update/{shops}', [ShopController::class,'update'])->name('update');
    Route::get('/getData', [ShopController::class,'getData'])->name('getData');

});

//product routes
Route::group(['prefix'=>'products','middleware'=>'auth','as'=>'products.'], function(){
    Route::get('/', [ProductController::class,'index'])->name('index');
    Route::get('/store', [ProductController::class,'store'])->name('store');
    Route::get('/show', [ProductController::class,'show'])->name('show');
    Route::get('/{id}/edit', [ProductController::class,'edit'])->name('edit');
    Route::get('/destroy/{shops}', [ProductController::class,'destroy'])->name('destroy');
    Route::get('/update/{shops}', [ProductController::class,'update'])->name('update');
});
