<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Models\Place;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $places = Place::all();

    return view('welcome', compact('places'));
});

Route::get('/dashboard', function () {
    $places = auth()->user()->places;

    return view('dashboard', compact('places'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/weather', [WeatherController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('weather.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
