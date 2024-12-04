<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

class WeatherApiService
{
    protected $baseUrl;
    protected $apiKey;

    // Base URL and API key are fetched from the config/services.php file, they key itself is stored in the .env file.
    public function __construct()
    {
        $this->baseUrl = config('services.weatherapi.url', env('WEATHER_API_URL'));
        $this->apiKey = config('services.weatherapi.key', env('WEATHER_API_KEY'));
    }


    // Fetches the current weather data for a given location.
    public function getCurrentWeather($location)
    {
        // Perform a GET request to fetch current weather data.
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/current.json", [
            'key' => $this->apiKey,
            'q' => $location,

        ]);

        if ($response->ok()) {
            return $response->json();
        }
        Log::error('Failed to fetch weather data', [
            'location' => $location,
            'response' => $response->body(),
        ]);

        return null;

    }
    // Perform a GET request to fetch forecast data.
    public function getForecast($location, $days = 1)
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/forecast.json", [
            'key' => $this->apiKey,
            'q' => $location,
            'days' => $days,
        ]);

        if ($response->ok()) {
            return $response->json();
        }

        Log::error('Failed to fetch weather forecast data', [
            'location' => $location,
            'response' => $response->body(),
        ]);

        return null;
    }
    // Perform a GET request to fetch weather data for the past 30 days
    public function getHistoricalWeather($location)
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/history.json", [
            'key' => $this->apiKey,
            'q' => $location,
            'dt' => now()->subDays(30)->format('Y-m-d'),
            'end_dt' => now()->subDays(1)->format('Y-m-d'),
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
