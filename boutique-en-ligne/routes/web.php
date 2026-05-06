<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\ProductController;
Route::get('/', function () {
    return redirect()->route('admin.products.index'); // ou return view('welcome');
});




Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

});


