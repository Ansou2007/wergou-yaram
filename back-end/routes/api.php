<?php

use App\Http\Controllers\Api\GardeController;
use App\Http\Controllers\Api\PharmacieController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VilleController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//===========CONNEXION REQUISE======

Route::middleware('auth:sanctum')->group(function () {


    // Utilisateur
    Route::controller(UserController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
    Route::controller(UserController::class)->group(function () {

        Route::get('/users', 'users');
    });
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //-----Garde
    // Route::post('/garde/store','store');
    // Ville
    Route::controller(VilleController::class)->group(function () {
        Route::post('/ville', 'store');
        Route::put('/ville/{id}/update', 'update');
    });
});



//======CONNEXION NON REQUISE
Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});





////////////////////////////// PATIENT /////////////////////////

//=======Pharmacies
Route::controller(PharmacieController::class)->group(function () {
    Route::get('/pharmacies', 'pharmacies');
    Route::get('/pharmacie/{id}', 'show');
});
//======Gardes
Route::controller(GardeController::class)->group(function () {
    Route::get('/gardes', 'gardes');
    Route::get('/garde/{id}/', 'show');
});
//======  Villle
Route::controller(VilleController::class)->group(function () {
    Route::get('/villes', 'villes');
});
