<?php

use App\Http\Controllers\CustomAuth\AuthController;

Route::get('register' , [AuthController::class,"register"])->name("auth.register");
Route::post('register' , [AuthController::class ,"action"])->name("auth.action");
Route::post('logout' , [AuthController::class ,"logout"])->name("auth.logout");
Route::get('login' , [AuthController::class ,"login"])->name("login");
Route::post('login' , [AuthController::class ,"doLogin"])->name("doLogin");





