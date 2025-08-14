<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTicketController;
use App\Http\Controllers\FerryScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Resource routes for all controllers
    Route::resource('bookings', BookingController::class);
    Route::resource('events', EventController::class);
    Route::resource('event-tickets', EventTicketController::class);
    Route::resource('ferry-schedules', FerryScheduleController::class);
    Route::resource('ferry', App\Http\Controllers\FerryTicketController::class);
});

require __DIR__.'/auth.php';
