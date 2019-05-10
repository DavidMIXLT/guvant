<?php
use AlaCartaYa\Order;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    $order = Order::all();
    return view('panel',['orders' => $order]);
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
/**
 * Orders
 */
Route::get('/panel/orders/MenuModal/{id}', 'OrderController@getMenuModal');
Route::get('/panel/orders/addProducts', 'OrderController@getProductsModal');
Route::get('/panel/orders/addPlates','OrderController@getPlatesModal');
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
 * Users
 */
Route::resource('/panel/users', 'UserController');
//--------------------------------------------------------------------------------------------------------------------//
/**
 * AUTH
 */
Auth::routes();
Route::get('/home', function () {
    $order = Order::all();
    return view('panel',['orders' => $order]);
})->name('panel')->middleware('auth');