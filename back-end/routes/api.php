<?php

use App\Http\Controllers\Api\GardeController;
use App\Http\Controllers\Api\PharmacieController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VilleController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

//=======Utilisateur

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//======User Register & Login
Route::controller(UserController::class)->group(function(){
    Route::post('/login','login');
    Route::post('/register','register');
});



Route::controller(UserController::class)->group(function(){

    Route::get('/users','index')->name('user.all');
})->middleware('auth:sanctum');



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


//======  Villle

Route::controller(VilleController::class)->group(function(){

    Route::get('/villes','villes');
    Route::post('/ville/store','store');
});




