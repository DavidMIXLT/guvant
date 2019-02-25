<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->name('panel');
//--------------------------------------------------------------------------------------------------------------------//
/**
 * Products Routes
 */
Route::get('panel/products/entrada', 'ProductController@printIncomingProductOrders')->name('entradaProducto');
Route::get('panel/products/pagination','ProductController@getPaginationLinks');
Route::post('panel/products/NumberOfItems','ProductController@setNumberOfItems');
Route::post('panel/products/filter','ProductController@filter');
Route::post('panel/products/masDel', 'ProductController@massiveElimination');
Route::resource('/panel/products', 'ProductController');

//--------------------------------------------------------------------------------------------------------------------//
/**
 * Products Plates
 */
Route::resource('/panel/plates', 'PlateController');
//--------------------------------------------------------------------------------------------------------------------//
Route::resource('/panel/orders', 'OrderController');

Route::resource('/panel/categories', 'CategoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
