<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CheckInController;
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

    // Admin Routes
    Route::get('/admin/check-in', [CheckInController::class, 'index'])->name('admin.check-in.index');
    Route::post('/admin/check-in', [CheckInController::class, 'process'])->name('admin.check-in.process');
});

// ============ REGISTRATION (Lydia) -- START ============
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [\App\Http\Controllers\RegistrationController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('events.register');
    Route::get('/my-tickets', [\App\Http\Controllers\RegistrationController::class, 'myTickets'])->name('registrations.mine');
});
// ============ REGISTRATION (Lydia) -- END ============

require __DIR__.'/auth.php';

