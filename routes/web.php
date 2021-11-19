<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('txn_types')
      ->group(function(){

            Route::get('/','App\Http\Controllers\TransactionTypeController@index');
            Route::get('/show/{transactionType}','App\Http\Controllers\TransactionTypeController@show');
            Route::get('/create','App\Http\Controllers\TransactionTypeController@create');
            Route::post('/store','App\Http\Controllers\TransactionTypeController@store');

            Route::get('/edit/{transactionType}','App\Http\Controllers\TransactionTypeController@edit');
            Route::post('/update/{transactionType}','App\Http\Controllers\TransactionTypeController@update');

            Route::post('/destroy/{transactionType}','App\Http\Controllers\TransactionTypeController@destroy');

        });

Route::prefix('transaction')
    ->middleware('mysecurearea')
    ->group(function(){
    Route::get('/create',[TransactionController::class,'create'])->name('transaction.create');
    Route::post('/store',[TransactionController::class,'store'])->name('transaction.store');
});