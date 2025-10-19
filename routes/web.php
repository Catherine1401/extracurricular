<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('check.role:organization')->group(function () {
        Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
        Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    });

    // Dashboard - Chỉ cho organization và user (không cho admin)
    Route::middleware('check.role:organization,user')->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    });
    
    // Xem chi tiết activity - Tất cả user
    Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');

    // Quản lý hoạt động - Chỉ activities của organization
    Route::middleware('check.role:admin,organization')->group(function () {
        Route::get('/my-activities', [ActivityController::class, 'myActivities'])->name('activities.my');
        Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
        Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
        Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
    });

    // Routes chỉ cho admin
    Route::middleware('check.role:admin')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
});

require __DIR__.'/auth.php';
