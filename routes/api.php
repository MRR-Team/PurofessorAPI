<?php

use App\Http\Controllers\ChampionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/{id}', 'show')->name('users.show');
    Route::post('/users', 'store')->name('users.store');
    Route::put('/users/{id}', 'update')->name('users.update');
    Route::delete('/users/{id}', 'destroy')->name('users.destroy');
});

Route::controller(ChampionController::class)->group(function () {
    Route::get('/champions', 'index')->name('champions.index');
    Route::get('/champions/{id}', 'show')->name('champions.show');
    Route::post('/champions', 'store')->name('champions.store');
    Route::put('/champions/{id}', 'update')->name('champions.update');
    Route::delete('/champions/{id}', 'destroy')->name('champions.destroy');
});
