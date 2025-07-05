<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventRegistrationController;
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
});

// Admin-specific routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Event Management CRUD routes
    // The `resource` method automatically generates all 7 CRUD routes (index, create, store, show, edit, update, destroy)
    // The `names` method gives them consistent names like 'admin.events.index', 'admin.events.create', etc.
    Route::resource('admin/events', EventController::class)->names('admin.events');
});

// User-facing public event list and registration actions
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventRegistrationController::class, 'index'])->name('events.index');
    Route::post('/events/{event}/register', [EventRegistrationController::class, 'register'])->name('events.register');
    Route::post('/events/{event}/unregister', [EventRegistrationController::class, 'unregister'])->name('events.unregister');
});

require __DIR__.'/auth.php';
