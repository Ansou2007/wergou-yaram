<?php

use App\Http\Controllers\Api\GardeController;
use App\Http\Controllers\Api\PharmacieController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

//=======Utilisateur
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function(){
    Route::post('/login','login')->name('login');
    Route::post('/inscription','inscription')->name('user_inscription');
    Route::post('/deconnexion','deconnexion')->name('user_deconnexion');
});

Route::controller(UserController::class)->group(function(){

    Route::get('/users','index')->name('user.all');
});

//=======Pharmacies
Route::controller(PharmacieController::class)->group(function(){
    Route::get('/all','showAll')->name('all_pharmacie');
});

//======Gardes
Route::controller(GardeController::class)->group(function(){
    Route::get('/gardes','gardes')->name('all_garde');
    Route::get('/garde','create')->name('create_garde');
    Route::post('/garde','store')->name('store_garde');
});

