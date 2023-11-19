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


// ----------------------------------------- Mode output -----------------------------------------


Route::get("device_mode_check", [\App\Http\Controllers\EmployeeRegistrationController::class,'modeOutput']);

// ----------------------------------------- Mode output -----------------------------------------


// ------------------------------- Employee Registration ------------------------------------------

Route::get('employee-registration', [\App\Http\Controllers\EmployeeRegistrationController::class,'employee_registration']);

// ------------------------------- Employee Registration ------------------------------------------

// ------------------------------- Employee Registration ------------------------------------------

Route::get('employee-removal', [\App\Http\Controllers\EmployeeRegistrationController::class,'employee_removal']);

// ------------------------------- Employee Registration ------------------------------------------

// ------------------------------- Employee Registration ------------------------------------------

Route::get('attendance_entry', [\App\Http\Controllers\EmployeeRegistrationController::class,'attendance']);

// ------------------------------- Employee Registration ------------------------------------------
