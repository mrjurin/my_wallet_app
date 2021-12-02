<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;


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
    \Cookie::queue('auth', 'hello world');
    return view('welcome');
});


Route::get('/cookie', function () {  
    dd(gettype(1));
    //dd(\Cookie::get('auth'));   
});

Route::prefix('auth')
    ->group(function(){
        Route::get('/',[LoginController::class,'login'])->name('login');
        Route::post('/authenticate',[LoginController::class,'authenticate'])->name('authenticate');
        Route::get('/logout',[LoginController::class,'logout'])->name('logout');
    });

Route::prefix('txn_types')
      ->group(function(){

            Route::get('/','App\Http\Controllers\TransactionTypeController@index')->name('txn_types');
            Route::get('/show/{transactionType}','App\Http\Controllers\TransactionTypeController@show');
            Route::get('/create','App\Http\Controllers\TransactionTypeController@create');
            Route::post('/store','App\Http\Controllers\TransactionTypeController@store');

            Route::get('/edit/{transactionType}','App\Http\Controllers\TransactionTypeController@edit');
            Route::post('/update/{transactionType}','App\Http\Controllers\TransactionTypeController@update');

            Route::post('/destroy/{transactionType}','App\Http\Controllers\TransactionTypeController@destroy');

        });

Route::prefix('transaction')
    ->group(function(){
    Route::get('/',[TransactionController::class,'index'])->name('transaction');
    Route::get('/transactionsByAccount/{account_id}',[TransactionController::class,'transactionsByAccount'])
        ->name('transaction.by_account');
    Route::get('/create',[TransactionController::class,'create'])->name('transaction.create');
    Route::post('/store',[TransactionController::class,'store'])->name('transaction.store');
});

Route::prefix('user')
    ->middleware(['auth'])
    ->group(function(){
        Route::get('/',[UserController::class,'index'])->name('user');
    });

Route::prefix('wallets')
    ->middleware('auth')
    ->group(function(){

        Route::get('/',[AccountController::class,'index'])->name('wallets');
        Route::get('/topup/{wallet}',[AccountController::class,'topup'])->name('wallets.topup');
        Route::post('/make_topup/{wallet}',[AccountController::class,'make_topup'])->name('wallets.make_topup');
        Route::get('/transfer/{wallet}',[AccountController::class,'transfer'])->name('wallets.transfer');
        Route::post('/make_transfer/{wallet}',[AccountController::class,'make_transfer'])->name('wallets.make_transfer');
        Route::get('/request_money/{wallet}',[AccountController::class,'request_money'])->name('wallets.request_money');
        Route::post('/make_request_money/{wallet}',[AccountController::class,'make_request_money'])->name('wallets.make_request_money');

        
        Route::get('/pending_request_money',[AccountController::class,'pendingRequest'])->name('wallets.pending_request_money');


        Route::get('/pending_request_confirmation',[AccountController::class,'pendingRequestConfirmation'])->name('wallets.pending_request_confirmation');
        Route::post('/confirm_request_money/{wallet}/{transaction}',[AccountController::class,'confirm_request_money'])->name('wallets.confirm_request_money');

    });