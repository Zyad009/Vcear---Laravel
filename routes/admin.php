<?php

use App\Http\Controllers\Admin\MajorController;


Route::get('majors/add',[MajorController::class,"create"]);
Route::post('majors',[MajorController::class,"store"]);
Route::get('majors/{major}/edit',[MajorController::class,"edit"]);
Route::put('major/{major}' ,[MajorController::class,"update"]);
Route::delete('major/{major}' ,[MajorController::class,"destroy"]);










