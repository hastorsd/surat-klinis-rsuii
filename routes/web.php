<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\KsmController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SpesialisController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('public.files.index');
Route::get('/files/{files}/download', [PublicController::class, 'download'])->name('public.files.download');
Route::get('/files/{files}/preview', [PublicController::class, 'preview'])->name('public.files.preview');
    
// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('files', FileController::class)->parameters(['files' => 'files']);
    Route::resource('ksm', KsmController::class);
    Route::resource('spesialis', SpesialisController::class)->parameters(['spesialis' => 'spesialis']);
    Route::resource('category', CategoryController::class);
    Route::get('/master-data', [MasterController::class, 'index'])->name('master');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
