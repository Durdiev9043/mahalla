<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/operator/home',[App\Http\Controllers\operator\HomeController::class,'home'])->name('operator.home');
Route::group(['middleware' => ['role:operator']], function () {
    Route::resource('village',\App\Http\Controllers\VillageController::class);
    Route::resource('operator/user',\App\Http\Controllers\operator\UserController::class);
    Route::resource('location',\App\Http\Controllers\operator\LocationController::class);
});
