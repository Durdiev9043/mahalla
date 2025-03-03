<?php


use Illuminate\Support\Facades\Route;

Route::post('login',[App\Http\Controllers\Api\AuthController::class,'login']);
Route::middleware(['auth:sanctum'/*, 'abilities:check-status'*/])->group(function () {
    Route::post('come/office',[App\Http\Controllers\Api\HomeController::class,'come']);
    Route::post('come/about/{id}',[App\Http\Controllers\Api\HomeController::class,'about']);
});
