<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/operator/home',[App\Http\Controllers\operator\HomeController::class,'home'])->name('operator.home');
Route::group(['middleware' => ['role:operator']], function () {
    Route::resource('village',\App\Http\Controllers\VillageController::class);
    Route::resource('operator/user',\App\Http\Controllers\operator\UserController::class);
    Route::resource('location',\App\Http\Controllers\operator\LocationController::class);
    Route::get('today/came',[\App\Http\Controllers\operator\HomeController::class,'today'])->name('today');
//    Route::post('/compare-faces', [\App\Http\Controllers\operator\HomeController::class, 'compareFaces']);
//    Route::get('/test', function (){return view('test');});
    Route::get('/lavozim', function (){return view('lavozim');});
    Route::get('/user/edit/{id}', [\App\Http\Controllers\operator\HomeController::class,'userEdit'])->name('edit');
    Route::put('/user/update/{id}', [\App\Http\Controllers\operator\HomeController::class,'userUpdate'])->name('update');
    Route::get('/seven', [\App\Http\Controllers\operator\HomeController::class,'extraLocation'])->name('seven');
    Route::get('/filter/date', [\App\Http\Controllers\operator\HomeController::class,'date'])->name('date');
    Route::get('location/extra', [\App\Http\Controllers\operator\HomeController::class,'extraLocation'])->name('extraLocation');
    Route::get('current/location/', [\App\Http\Controllers\operator\HomeController::class,'currentLocation'])->name('currentLocation');
    Route::get('current/location/village/{id}', [\App\Http\Controllers\operator\HomeController::class,'currentLocationVillage'])->name('currentLocationVillage');
    Route::get('current/location/village/user/{id}', [\App\Http\Controllers\operator\HomeController::class,'currentLocationVillageUser'])->name('currentLocationVillageUser');
});
