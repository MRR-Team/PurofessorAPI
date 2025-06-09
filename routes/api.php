<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ChampionController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::middleware('auth:sanctum')->post('/logout', 'logout');
    Route::post('/register', 'register')->name('register');
    Route::post('/forgot-password',  'sendResetLinkEmail');
    Route::post('/reset-password',  'reset');
    Route::get('/reset-password/{token}', function ($token) {
        return redirect("https://frontend.example.com/reset-password?token=$token");
    })->name('password.reset');
});

Route::get('/auth/redirect/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('/auth/callback/google', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::controller(ChampionController::class)->group(function () {
    Route::get('/champions', 'index')->name('champions.index');
    Route::get('/champions/{champion}', 'show')->name('champions.show');
    Route::get('/available-champions', 'availableChampions')->name('champions.available');
});
Route::middleware(['auth:sanctum', 'role:admin'])->controller(ChampionController::class)->group(function () {
    Route::post('/champions', 'store')->name('champions.store');
    Route::put('/champions/{champion}', 'update')->name('champions.update');
    Route::delete('/champions/{champion}', 'destroy')->name('champions.destroy');
    Route::patch('/champions/{champion}/toggle-availability', 'toggleChampionAvailability')->name('champions.availability.update');
});

Route::controller(ItemController::class)->group(function () {
    Route::get('/items', 'index')->name('items.index');
    Route::get('/items/{item}', 'show')->name('items.show');
});
Route::middleware(['auth:sanctum', 'role:admin'])->controller(ItemController::class)->group(function () {
    Route::post('/items', 'store')->name('items.store');
    Route::put('/items/{item}', 'update')->name('items.update');
    Route::delete('/items/{item}', 'destroy')->name('items.destroy');
});

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->middleware('role:admin')->name('users.index');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::put('/users/{user}', 'update')->name('users.update');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
});

Route::get('/counter/{role}/{enemyChampion}', CounterController::class);
Route::middleware('auth:sanctum')->get('/build/{enemyChampion}/against/{champion}', BuildController::class);

Route::middleware(['auth:sanctum','role:admin'])->controller(StatsController::class)->group(function () {
    Route::get('/stats/counter-search', 'SearchStats')->name('stats.counter-search');
    Route::get('/stats/logs', 'Logs')->name('stats.counter-search');
});

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::middleware('auth:sanctum')->controller(NotificationController::class)->group(function () {
    Route::get('/notifications', 'getUserNotifications');
    Route::middleware('role:admin')->post('/notifications/send', 'send');
});
