<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Artisan::command('fetchWeatherData', function () {
    $locations = App\Models\Location::all();
    $weatherService = new App\Services\WeatherApiService();

    foreach ($locations as $location) {
        try {
            $currentWeather = $weatherService->getCurrentWeather($location->name);
            if (!$currentWeather) {
                $this->error("Failed to fetch weather data for {$location->name}");
                continue;
            }

            $weatherReading = new App\Models\WeatherReading();
            $weatherReading->location_id = $location->id;
            $weatherReading->temp_c = $currentWeather['current']['temp_c'];
            $weatherReading->condition_text = $currentWeather['current']['condition']['text'];
            $weatherReading->condition_icon = $currentWeather['current']['condition']['icon'];
            $weatherReading->last_updated = $currentWeather['current']['last_updated'];
            $weatherReading->save();

            $this->info("Fetched weather data for {$location->name}");
        } catch (\Exception $e) {
            $this->error("Error processing {$location->name}: " . $e->getMessage());
            Log::error('Weather data fetch failed', ['location' => $location->name, 'error' => $e->getMessage()]);
        }
    }
})->purpose('Fetch weather data for all locations');

Schedule::command('fetchWeatherData')->everyFiveMinutes();

// Will have to be run locally with php artisan schedule:work
