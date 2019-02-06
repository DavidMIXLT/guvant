<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->name('panel');

Route::get('panel/products/entrada', 'ProductController@printIncomingProductOrders')->name('entradaProducto');

Route::resource('/panel/products', 'ProductController');

Route::resource('/panel/plates', 'PlateController');

Route::resource('/panel/orders', 'OrderController');

Route::resource('/panel/categories', 'CategoryController');



