<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->name('panel');

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

Route::resource('/panel/categories', 'CategoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//--------------------------------------------------------------------------------------------------------------------//
/**
 *  Menus
 */
Route::resource('/panel/menus', 'MenusController');
//--------------------------------------------------------------------------------------------------------------------//