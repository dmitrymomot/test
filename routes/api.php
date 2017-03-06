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

Route::post('customers/{id}/deposit', 'CustomerTransactionsController@deposit')
    ->where(['id' => '[0-9]+']);
Route::post('customers/{id}/withdraw', 'CustomerTransactionsController@withdraw')
    ->where(['id' => '[0-9]+']);
Route::get('reports/summary/{start_date?}/{end_date?}', 'ReportsController@getSummary')
    ->where([
        'start_date' => 'date',
        'end_date' => 'date',
    ]);
