<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [\App\Http\Controllers\TestModelController::class, 'dashboard']);


Route::middleware('auth')->prefix('admin')->group(function (){

    // ------------------------------- Devices ------------------------------------------

    Route::resource('device', \App\Http\Controllers\DeviceController::class);

    // ------------------------------- Devices ------------------------------------------

    // ------------------------------- Employee info update ------------------------------------------

    Route::resource('employee', \App\Http\Controllers\EmployeeWebController::class);

    // ------------------------------- Employee info update ------------------------------------------

    // ------------------------------- Employee info update ------------------------------------------

    Route::resource('attendance', \App\Http\Controllers\AttendanceController::class);

    // ------------------------------- Employee info update ------------------------------------------

    // ------------------------------- logout ------------------------------------------

    Route::get('log_out', function (){
        \auth()->logout();
        return redirect()->route("login");
    })->name('log_out');

    // ------------------------------- logout ------------------------------------------



});



