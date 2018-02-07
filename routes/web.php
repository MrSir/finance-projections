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

Route::name('Home')->get('/', function () {
    return view('home');
});

Route::name('Transactions')->get('/transactions', function () {
    return view('transactions');
});

Route::name('Accounts')->get('/accounts', function () {
    return view('accounts');
});

Route::name('Categories')->get('/categories', function () {
    return view('categories');
});

Route::name('Frequencies')->get('/frequencies', function () {
    return view('frequencies');
});

Route::group(
    [
        'prefix' => '/report'
    ],
    function () {
        Route::name('Weekly Report')->get('/weekly', function () {
            return view('reports.weekly');
        });

        Route::name('Bi-Weekly Report')->get('/bi-weekly', function () {
            return view('reports.bi-weekly');
        });

        Route::name('Monthly Report')->get('/monthly', function () {
            return view('reports.monthly');
        });
    }
);

