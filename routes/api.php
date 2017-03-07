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

Route::resource('customers', 'CustomersController', [
    'only' => ['show', 'store', 'update']
]);

Route::post('customers/{customer}/deposit', 'CustomerTransactionsController@deposit')
    ->where(['customer' => '[0-9]+']);

Route::post('customers/{customer}/withdraw', 'CustomerTransactionsController@withdraw')
    ->where(['customer' => '[0-9]+'])
    ->middleware('max_withdraw');

Route::get('reports/summary/{start_date?}/{end_date?}', 'ReportsController@getSummary')
    ->middleware('check_date_range');
