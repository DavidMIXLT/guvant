<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->name('panel');

Route::resource('/panel/products', 'ProductController');
