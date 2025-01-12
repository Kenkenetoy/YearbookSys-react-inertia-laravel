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
Route::middleware('auth:sanctum')->group(function () {
    // List of user statuses
    $statuses = ['pending', 'approved', 'rejected', 'banned'];

    // Loop through each status and create the route
    foreach ($statuses as $status) {
        Route::get("/admin/users/{$status}", [UserController::class, "{$status}Users"]);
    }
});

Route::prefix('admin/users')->group(function () {
    // List of actions
    $actions = ['approve', 'reject', 'ban'];

    // Loop through each action and create the route
    foreach ($actions as $action) {
        Route::patch("{id}/{$action}", [UserController::class, $action])
            ->name("admin.users.{$action}");
    }
});


require __DIR__.'/auth.php';
