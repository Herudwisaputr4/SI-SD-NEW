<?php

use App\Http\Controllers\Admin\Siswa\SiswaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Guru\GuruController;
use App\Http\Controllers\Admin\TahunAjaran\TahunAjaranController;
use App\Http\Controllers\Admin\Kelas\KelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard']);
Route::get('profil', [DashboardController::class, 'editProfile'])->name('profil');
Route::put('profil/{id}', [DashboardController::class, 'update'])->name('profil.update');

Route::get('siswa', [SiswaController::class, 'index'])-> name('admin');
Route::get('siswa/create', [SiswaController::class, 'create'])-> name('admin');
Route::post('siswa', [SiswaController::class, 'store'])-> name('admin');
Route::get('siswa/show/{id}', [SiswaController::class, 'show'])-> name('admin');
Route::get('siswa/edit/{id}', [SiswaController::class, 'edit'])-> name('admin');
Route::put('siswa/{id}', [SiswaController::class, 'update'])-> name('admin');
Route::delete('siswa/destroy/{id}', [SiswaController::class, 'destroy'])-> name('admin');
Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
Route::get('siswa/export', [SiswaController::class, 'export'])->name('siswa.export');

Route::get('guru', [GuruController::class, 'index'])-> name('admin');
Route::get('guru/create', [GuruController::class, 'create'])-> name('admin');
Route::post('guru', [GuruController::class, 'store'])-> name('admin');
Route::get('guru/show/{id}', [GuruController::class, 'show'])-> name('admin');
Route::get('guru/edit/{id}', [GuruController::class, 'edit'])-> name('admin');
Route::put('guru/{id}', [GuruController::class, 'update'])-> name('admin');
Route::delete('guru/destroy/{id}', [GuruController::class, 'destroy'])-> name('admin');
Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
Route::get('guru/export', [GuruController::class, 'export'])->name('guru.export');

Route::get('tahun-ajaran', [TahunAjaranController::class, 'index'])->name('admin');
Route::get('tahun-ajaran/create', [TahunAjaranController::class, 'create'])->name('admin');
Route::post('tahun-ajaran', [TahunAjaranController::class, 'store'])->name('admin');
Route::get('tahun-ajaran/show/{id}', [TahunAjaranController::class, 'show'])->name('admin');
Route::get('tahun-ajaran/edit/{id}', [TahunAjaranController::class, 'edit'])->name('admin');
Route::put('tahun-ajaran/{id}', [TahunAjaranController::class, 'update'])->name('admin');
Route::delete('tahun-ajaran/destroy/{id}', [TahunAjaranController::class, 'destroy'])->name('admin');
Route::post('tahun-ajaran/import', [TahunAjaranController::class, 'import'])->name('tahun-ajaran.import');
Route::get('tahun-ajaran/export', [TahunAjaranController::class, 'export'])->name('tahun-ajaran.export');

Route::get('kelas', [KelasController::class, 'index'])->name('admin');
Route::get('kelas/create', [KelasController::class, 'create'])->name('admin');
Route::post('kelas', [KelasController::class, 'store'])->name('admin');
Route::get('kelas/show/{id}', [KelasController::class, 'show'])->name('admin');
Route::get('kelas/edit/{id}', [KelasController::class, 'edit'])->name('admin');
Route::put('kelas/{id}', [KelasController::class, 'update'])->name('admin');
Route::delete('kelas/destroy/{id}', [KelasController::class, 'destroy'])->name('admin');
