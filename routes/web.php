<?php

use App\Http\Controllers\GardeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Login
Route::get('/', function () {
    return view('login');
});

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Gardes
Route::middleware('auth')
->group(function(){
Route::controller(GardeController::class)->group(function(){
    Route::get('/gardes','index')->name('gardes');
});
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
