<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\http\Controllers\MasterAdmin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Master Admin Routes

Route::prefix('master-admin')->middleware('auth:master-admin')->group(function(){
    include "_/master-admin.php";
});

Route::prefix('admin')->middleware('auth:admin')->group(function(){
    include "_/admin.php";
});

Route::get('login', [AuthController::class, 'Login'])->name('login');
Route::post('login', [AuthController::class, 'LoginProses']);
Route::get('logout', [AuthController::class, 'Logout'])->name('logout');
Route::get('/add-admin', [AuthController::class, 'add']);