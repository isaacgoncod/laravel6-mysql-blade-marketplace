<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductImageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        // Route::prefix('stores')->name('stores.')->group(function(){
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store', 'StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::put('/update/{store}', 'StoreController@update')->name('update');
        //     Route::delete('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        // });

        //    Route::prefix('products')->name('products.')->group(function(){
        //     Route::get('/', 'ProductController@index')->name('index');
        //     Route::get('/create', 'ProductController@create')->name('create');
        //     Route::post('/store', 'ProductController@store')->name('store');
        //     Route::get('/{product}/edit', 'ProductController@edit')->name('edit');
        //     Route::put('/update/{product}', 'ProductController@update')->name('update');
        //     Route::delete('/destroy/{product}', 'ProductController@destroy')->name('destroy');
        // });

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('images/remove', 'ProductImageController@removeImage')->name('image.remove');

    });
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});
