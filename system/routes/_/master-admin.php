<?php

use App\Http\Controllers\MasterAdmin\Sekolah\SekolahController;
use App\Http\Controllers\MasterAdmin\Admin\AdminController;
use App\Http\Controllers\MasterAdmin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard']);
Route::get('profil', [DashboardController::class, 'editProfile'])->name('profil');
Route::put('profil/{id}', [DashboardController::class, 'update'])->name('profil.update');

Route::get('data-admin', [AdminController::class, 'index'])->name('master-admin');
Route::get('data-admin/create', [AdminController::class, 'create'])->name('master-admin');
Route::post('data-admin', [AdminController::class, 'store'])->name('master-admin');
Route::get('data-admin/show/{id}', [AdminController::class, 'show'])->name('master-admin');
Route::get('data-admin/edit/{id}', [AdminController::class, 'edit'])->name('master-admin');
Route::put('data-admin/{id}', [AdminController::class, 'update'])->name('master-admin');
Route::delete('data-admin/destroy/{id}', [AdminController::class, 'destroy'])->name('master-admin');

// Route untuk Data Sekolah
Route::get('data-sekolah', [SekolahController::class, 'index'])->name('master-admin');
Route::get('data-sekolah/create', [SekolahController::class, 'create'])->name('master-admin');
Route::post('data-sekolah', [SekolahController::class, 'store'])->name('master-admin');
Route::get('data-sekolah/show/{id}', [SekolahController::class, 'show'])->name('master-admin');
Route::get('data-sekolah/edit/{id}', [SekolahController::class, 'edit'])->name('master-admin');
Route::put('data-sekolah/{id}', [SekolahController::class, 'update'])->name('master-admin');
Route::delete('data-sekolah/destroy/{id}', [SekolahController::class, 'destroy'])->name('master-admin');
