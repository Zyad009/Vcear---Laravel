<?php

use App\Http\Controllers\Api\V1\Appointment\AppointmentController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Front\ContactController;
use App\Http\Controllers\Api\V1\Front\DoctorController;
use App\Http\Controllers\Api\V1\Front\HomeController;
use App\Http\Controllers\Api\V1\Front\MajorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});


Route::get('/v1/majors' , [MajorController::class , "index"]);
Route::get('/v1/majors/{id}' , [MajorController::class , "show"]);
Route::get('/v1/majors/{id}/doctors' , [MajorController::class , "doctors"]);

Route::get('/v1/doctors' , [DoctorController::class , "index"]);

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('/logout', [AuthController::class, "logout"])->middleware('auth:sanctum');

Route::get("/v1/contact" , [ContactController::class ,"index"]);
Route::get("/v1/contact/{id}" , [ContactController::class ,"show"]);
Route::post("/contact" , [ContactController::class ,"create"]);
Route::post("/v1/contact/delete/{id}" , [ContactController::class ,"delete"]);

Route::get("/v1/home" , [HomeController::class , "index"]);

Route::get("/v1/appointment" , [AppointmentController::class ,"index"]);
Route::get("/v1/appointment/{id}" , [AppointmentController::class ,"show"]);
Route::post("/v1/appointment/{doctor}" , [AppointmentController::class ,"create"]);
Route::post("/appointment/delete/{id}" , [AppointmentController::class ,"delete"]);