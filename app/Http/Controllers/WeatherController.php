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
            return redirect()->route('weather.show', ['city' => 'Copenhagen'])
                ->with('error', 'Unable to fetch weather data.');
        }

        return view('weather.show', compact('currentWeather', 'forecastData', 'currentLocation'));

    }

    public function showDay($city, $date)
    {
        $forecastData = $this->weatherApiService->getForecast($city, 7);

        if (!$forecastData) {
            return redirect()->route('weather.show', ['city' => $city])->with('error', 'Unable to fetch weather data.');
        }
        //dd($forecastData);
        $selectedDay = collect($forecastData['forecast']['forecastday'])->firstWhere('date', $date);

        if (!$selectedDay) {
            return redirect()->route('weather.show', ['city' => $city])->with('error', 'Date not found in forecast data.');
        }
        //dd($selectedDay);
        return view('weather.day', compact('forecastData', 'selectedDay', 'city'));
    }
}

