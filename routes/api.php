<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('api.browser')->group(function(){

// ----------------------------------------- Mode output -----------------------------------------


Route::get("device_mode_check", [\App\Http\Controllers\EmployeeRegistrationController::class,'modeOutput']);

// ----------------------------------------- Mode output -----------------------------------------

// ----------------------------------------- Mode output -----------------------------------------


Route::get("employee_check", [\App\Http\Controllers\TestModelController::class,'employee_check']);

// ----------------------------------------- Mode output -----------------------------------------


// ------------------------------- Employee Registration ------------------------------------------

Route::get('employee-registration', [\App\Http\Controllers\EmployeeRegistrationController::class,'employee_registration']);

// ------------------------------- Employee Registration ------------------------------------------

// ------------------------------- Employee Removal ------------------------------------------

Route::get('employee-removal', [\App\Http\Controllers\EmployeeRegistrationController::class,'employee_removal']);

// ------------------------------- Employee Removal ------------------------------------------

// ------------------------------- Attendance Entry ------------------------------------------

Route::get('attendance_entry', [\App\Http\Controllers\EmployeeRegistrationController::class,'attendance']);

// ------------------------------- Attendance Entry ------------------------------------------


});

