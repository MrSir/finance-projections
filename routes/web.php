<?php

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

Route::name('home')->get('/', function () {
    return view('home');
});

Route::name('transactions')->get('/transactions', function () {
    return view('transactions');
});

Route::name('accounts')->get('/accounts', function () {
    return view('accounts');
});

Route::name('categories')->get('/categories', function () {
    return view('categories');
});

Route::name('frequencies')->get('/frequencies', function () {
    return view('frequencies');
});