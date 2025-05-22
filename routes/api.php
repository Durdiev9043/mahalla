<?php


use Illuminate\Support\Facades\Route;

Route::post('login',[App\Http\Controllers\Api\AuthController::class,'login']);
Route::middleware(['auth:sanctum'/*, 'abilities:check-status'*/])->group(function () {
    Route::post('come/office',[App\Http\Controllers\Api\ComeController::class,'come']);
    Route::post('come/hokimyat',[App\Http\Controllers\Api\ComeController::class,'hokimyat']);
    Route::post('come/bandlik',[App\Http\Controllers\Api\ComeController::class,'bandlik']);
    Route::post('come/ijtimoyi',[App\Http\Controllers\Api\ComeController::class,'ijtimoyi']);
    Route::post('come/about/{id}',[App\Http\Controllers\Api\HomeController::class,'about']);

});
Route::get('location/{id}',[App\Http\Controllers\Api\HomeController::class,'location']);
