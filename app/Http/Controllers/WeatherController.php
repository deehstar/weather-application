<?php

namespace App\Http\Controllers;

use App\Services\WeatherApiService;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherApiService;
    protected $weatherService;

    public function __construct(WeatherApiService $weatherApiService, WeatherService $weatherService)
    {
        $this->weatherApiService = $weatherApiService;
        $this->weatherService = $weatherService;
    }

    public function show($city)
    {
        $currentWeather = $this->weatherService->getLatestWeatherReadingFromDatabase($city);
        $currentLocation = $this->weatherService->getLocationFromDatabase($city);
        $forecastData = $this->weatherApiService->getForecast($city, 7);

        if (!$currentWeather || !$forecastData) {
            return redirect()->route('weather.home', ['city' => 'Copenhagen'])
                ->with('error', 'Unable to fetch weather data.');
        }

        return view('weather.home', compact('currentWeather', 'forecastData', 'currentLocation'));

    }

    public function showDay($city, $date)
    {
        $forecastData = $this->weatherApiService->getForecast($city, 7);

        if (!$forecastData) {
            return redirect()->route('weather.home', ['city' => $city])->with('error', 'Unable to fetch weather data.');
        }

        $selectedDay = collect($forecastData['forecast']['forecastday'])->firstWhere('date', $date);

        if (!$selectedDay) {
            return redirect()->route('weather.home', ['city' => $city])->with('error', 'Date not found in forecast data.');
        }

        return view('weather.forecast', compact('forecastData', 'selectedDay', 'city'));
    }

    public function showHistoricalWeather($city)
    {
        $historicalWeather = $this->weatherApiService->getHistoricalWeather($city);

        if (!$historicalWeather) {
            return redirect()->route('weather.home', ['city' => $city])
                ->with('error', 'Unable to fetch historical weather data.');
        }
        // Reverse the array of forecast days so that the most recent day is first
        $reversedForecastDays = array_reverse($historicalWeather['forecast']['forecastday']);
        $historicalWeather['forecast']['forecastday'] = $reversedForecastDays;

        return view('weather.history', compact('historicalWeather', 'city'));
    }
}

