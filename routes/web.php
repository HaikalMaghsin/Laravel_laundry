<?php

use App\Http\Controllers\Cust_controller;
use App\Http\Controllers\Customer_controller;
use App\Http\Controllers\Outlet_Controller;
use App\Http\Controllers\Paket_controller;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\Pkt_controller;
use App\Http\Controllers\Transaksi_controller;
use App\Http\Controllers\User_Controller;
use App\Models\Customer;
use App\Models\Outlet;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['Middleware' => 'Auth'], function(){
    // customer
    Route::resource('customer', Cust_controller::class);
    // paket
    Route::resource('paket', Paket_controller::class);
    // outlet
    Route::resource('outlet', Outlet_Controller::class);
    // user
    Route::resource('user', User_Controller::class);
    //transaksi
    Route::resource('transaksi', Transaksi_controller::class);
    

});