<?php

use App\Http\Controllers\Front\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\DoctorController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MajorsController;
use App\Http\Controllers\test\TestForYou;
use App\Models\Major;

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


Route::get('/' ,[HomeController::class,"index"])->name('home');


Route::get("/majors" , [MajorsController::class,"index"])->can("viewAny", Major::class);
Route::get("/majors/{major}/doctors" , [MajorsController::class,"doctors"]);
Route::get("/doctors",[DoctorController::class,"index"]);

Route::middleware('auth')->group(function(){
  Route::get("/appointments/{user}",[AppointmentController::class,"create"])->name('appointments.create');
  Route::post("/appointments/{user}",[AppointmentController::class,"store"])->name('appointments.store')->middleware('admin.area');
});

Route::get('/contact' , [ContactController::class,"index"])->can("make-appointment");
Route::post("/send-message",[ContactController::class, "sendMessage"]);


require_once ("admin.php");
require_once (__DIR__."/auth.php");
require_once(__DIR__."/api.php");


