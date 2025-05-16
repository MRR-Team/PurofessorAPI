<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ChampionController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::controller(UserController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::post('/users', 'store')->name('users.store');
    Route::put('/users/{user}', 'update')->name('users.update');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
});

Route::controller(ChampionController::class)->group(function () {
    Route::get('/champions', 'index')->name('champions.index');
    Route::get('/champions/{champion}', 'show')->name('champions.show');
    Route::post('/champions', 'store')->name('champions.store');
    Route::put('/champions/{champion}', 'update')->name('champions.update');
    Route::delete('/champions/{champion}', 'destroy')->name('champions.destroy');
});

Route::controller(ItemController::class)->group(function () {
    Route::get('/items', 'index')->name('items.index');
    Route::get('/items/{item}', 'show')->name('items.show');
    Route::post('/items', 'store')->name('items.store');
    Route::put('/items/{item}', 'update')->name('items.update');
    Route::delete('/items/{item}', 'destroy')->name('items.destroy');
});

Route::get('/counter/{role}/{enemyChampion}', CounterController::class);
Route::get('/build/{enemyChampion}/against/{champion}', BuildController::class);
