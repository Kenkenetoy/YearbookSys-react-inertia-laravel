<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/api.php
Route::middleware('auth:sanctum')->get('/admin/users/pending', [UserController::class, 'pendingUsers']);
Route::middleware('auth:sanctum')->get('/admin/users/approved', [UserController::class, 'approvedUsers']);
Route::middleware('auth:sanctum')->get('/admin/users/rejected', [UserController::class, 'rejectedUsers']);
Route::prefix('admin/users')->group(function () {
    Route::patch('{id}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::patch('{id}/reject', [UserController::class, 'reject'])->name('admin.users.reject');
});

require __DIR__.'/auth.php';
