<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('weather.show', ['city' => 'Copenhagen']);
});
Route::get('/weather/{city}', [WeatherController::class, 'show'])->name('weather.show');
Route::get('/weather/{city}/{date}', [WeatherController::class, 'showDay'])->name('weather.day');
Route::get('/history/{location}', [WeatherController::class, 'showHistoricalWeather'])->name('weather.history');