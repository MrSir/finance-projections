<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')
    ->get(
        '/user',
        function (Request $request) {
            return $request->user();
        }
    );

Route::resource(
    '/account',
    'AccountController',
    [
        'only' => [
            'index',
            'store',
            'update',
            'destroy'
        ]
    ]
);
Route::resource(
    '/category',
    'CategoryController',
    [
        'only' => [
            'index',
            'store',
            'update',
            'destroy'
        ]
    ]
);
Route::resource(
    '/transaction/frequency',
    'Transaction\FrequencyController',
    [
        'only' => [
            'index',
            'store',
            'update',
            'destroy'
        ]
    ]
);
Route::resource(
    '/transaction',
    'TransactionController',
    [
        'only' => [
            'index',
            'store',
            'update',
            'destroy'
        ]
    ]
);
Route::group(
    [
        'prefix' => '/report'
    ],
    function () {
        Route::get('/monthly', 'ReportController@monthly');
    }
);
