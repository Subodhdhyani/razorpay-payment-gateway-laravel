<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\Displayrecord;

Route::get('/', function () {
    return view('welcome');
});

//Store record inside db after payment
Route::post('/razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');

//Display Record on view from db and then from that do refund by button
Route::get('/display', [Displayrecord::class, 'display'])->name('display');


//Refund Route
Route::get('/refund{id?}', [RazorpayController::class, 'refund'])->name('refund');


