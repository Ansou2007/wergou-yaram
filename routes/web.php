<?php

use App\Http\Controllers\GardeController;
use App\Http\Controllers\PharmacieController;
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

    // Garde
Route::controller(GardeController::class)->group(function(){
    Route::get('/gardes','index')->name('gardes');
    Route::post('/gardes','store')->name('garde.store');
    Route::get('/garde/{id}/show','show')->name('garde.show');
    Route::put('/garde/update','update')->name('garde.update');
    Route::get('/garde/{id}/delete','destroy')->name('garde.delete');
});
    // Pharmacie
    Route::controller(PharmacieController::class)->group(function(){
        Route::get('/pharmacies','index')->name('pharmacie');
        Route::post('/pharmacie','store')->name('pharmacie.store');
        Route::get('/pharmacie/{id}/show','show')->name('pharmacie.show');
        Route::get('/pharmacie/{id}/edit','edit')->name('pharmacie.edit');
        Route::put('/pharmacie/update','update')->name('pharmacie.update');
        Route::get('/pharmacie/{id}/delete','destroy')->name('pharmacie.delete');
    });

});
/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';
