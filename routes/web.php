<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'ServiceCategoryController@welcome_categories');
Route::post('/','EmailController@send')->name('send');

Route::get('/services', function(){
    return view('all-services');
});
Route::get('/produse', function(){
    return view('all-products');
});

Route::get('/services', 'ServiceCategoryController@all_services_categories');
Route::get('/produse', 'ServiceCategoryController@all_products_categories');

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => '/admin/categories'], function() {
    Route::get('/products/show', 'ProductCategoryController@show')->name('categories.show_product');
    Route::get('/products/create', 'ProductCategoryController@create')->name('categories.create_product');
    Route::post('/products/store', 'ProductCategoryController@store')->name('categories.store_product');
    Route::get('/products/destroy/{id}', 'ProductCategoryController@destroy')->name('categories.destroy_product');
    Route::get('/products/edit/{category}', 'ProductCategoryController@edit')->name('categories.edit_product');
    Route::put('/products/update/{category}', 'ProductCategoryController@update')->name('categories.update_product');

    Route::get('/services/show', 'ServiceCategoryController@show')->name('categories.show_service');
    Route::get('/services/create', 'ServiceCategoryController@create')->name('categories.create_service');
    Route::post('/services/store', 'ServiceCategoryController@store')->name('categories.store_service');
    Route::get('/services/destroy/{id}', 'ServiceCategoryController@destroy')->name('categories.destroy_service');
    Route::get('/services/edit/{category}', 'ServiceCategoryController@edit')->name('categories.edit_service');
    Route::put('/services/update/{category}', 'ServiceCategoryController@update')->name('categories.update_service');
});

Route::group(['middleware' => 'auth', 'prefix' => '/admin/products'], function() {
    Route::get('/show', 'ProductController@show')->name('products.show');
    Route::get('/edit/{product}', 'ProductController@edit')->name('products.edit');
    Route::put('/update/{product}', 'ProductController@update')->name('products.update');
    Route::get('/create', 'ProductController@create')->name('products.create');
    Route::post('/store', 'ProductController@store')->name('products.store');
    Route::get('/destroy/{id}', 'ProductController@destroy')->name('products.destroy');
    Route::post('/destroy/image', 'ProductController@destroyImage')->name('products.image_destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => '/admin/services'], function() {
    Route::get('/show', 'ServiceController@show')->name('services.show');
    Route::get('/edit/{category}', 'ServiceController@edit')->name('services.edit');
    Route::put('/update/{category}', 'ServiceController@update')->name('services.update');
    Route::get('/create', 'ServiceController@create')->name('services.create');
    Route::post('/store', 'ServiceController@store')->name('services.store');
    Route::get('/destroy/{id}', 'ServiceController@destroy')->name('services.destroy');
    Route::post('/destroy/image', 'ServiceController@destroyImage')->name('services.image_destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => '/admin'], function() {
    Route::get('/',  function(){
        return view('documentation'); });
    Route::get('/documentation', function(){
        return view('documentation'); });
    Route::get('/inbox', 'EmailController@show')->name('inbox');
    Route::get('/inbox/destroy/{id}', 'EmailController@destroy')->name('inbox.destroy');
});

