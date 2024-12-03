<?php

namespace App\Http\Controllers;

use App\Services\WeatherApiService;
use Illuminate\Http\Request;

/*
class WeatherController extends Controller
{
    protected $weatherApiService;

    public function __construct(WeatherApiService $weatherApiService)
    {
        $this->weatherApiService = $weatherApiService;
    }

    public function show($city)
    {
        $weatherData = $this->weatherApiService->getCurrentWeather($city);

        if (!$weatherData) {
            return redirect()->route('weather.show', ['city' => 'Copenhagen'])->with('error', 'Unable to fetch weather data.');
        }

        return view('weather.show', compact('weatherData'));
    }
}
*/
class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherApiService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function show($city)
    {
        $currentWeather = $this->weatherService->getCurrentWeather($city);
        $forecastData = $this->weatherService->getForecast($city, 7);

        if (!$currentWeather || !$forecastData) {
            return redirect()->route('weather.show', ['city' => 'Copenhagen'])
                ->with('error', 'Unable to fetch weather data.');
        }

        return view('weather.show', compact('currentWeather', 'forecastData'));

    }

    public function showDay($city, $date)
    {
        $forecastData = $this->weatherService->getForecast($city, 7);

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

