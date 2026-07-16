<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LB\LBController;

Route::get('/',function(){
    return redirect('/dashboard');
});

Route::resource('dashboard',DashboardController::class);

Route::resource('lb',LBController::class);