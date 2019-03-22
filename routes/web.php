<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->name('panel')->middleware('auth');
//--------------------------------------------------------------------------------------------------------------------//
/**
 * Functions
 */
Route::post('panel/NumberOfItems','PaginationController@setNumberOfItems');
Route::post('panel/filter','PaginationController@filter');

//--------------------------------------------------------------------------------------------------------------------//
/**
 * Products Routes
 */
Route::get('panel/products/entrada', 'ProductController@printIncomingProductOrders')->name('entradaProducto');
Route::post('panel/products/masDel', 'ProductController@massiveElimination');
Route::resource('/panel/products', 'ProductController');
//--------------------------------------------------------------------------------------------------------------------//
/**
 *  Plates
 */
Route::resource('/panel/plates', 'PlateController');
//--------------------------------------------------------------------------------------------------------------------//
Route::resource('/panel/orders', 'OrderController');
/**
 * Categories
 */
Route::resource('/panel/categories', 'CategoryController');
//--------------------------------------------------------------------------------------------------------------------//
/**
 *  Menus
 */
Route::post('/panel/menus/newGroup', 'MenusController@newGroup');
Route::get('/panel/menus/searchModal','MenusController@searchModal');
Route::resource('/panel/menus', 'MenusController');
//--------------------------------------------------------------------------------------------------------------------//
/**
 * AUTH
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');