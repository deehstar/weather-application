<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Location;

class WeatherService
{
    public function getLatestWeatherReadingFromDatabase(string $locationName)
    {
        $location = Location::where('name', $locationName)->first();

        if ($location) {
            return $location->latestWeatherReading;
        }

        return null;
    }

    public function getLocationFromDatabase(string $locationName)
    {
        $location = Location::where('name', $locationName)->first();

        if ($location) {
            return $location;
        }

        return null;
    }

    public function getSelectedDayForecast(array $forecastData, string $date)
    {
        $forecastDay = collect($forecastData['forecast']['forecastday'])->firstWhere('date', $date);

        if (!$forecastDay) {
            return null;
        }

        return $forecastDay;
    }

    public function processHistoricalWeatherData(array $historicalWeather)
    {
        if (isset($historicalWeather['forecast']['forecastday'])) {
            $historicalWeather['forecast']['forecastday'] = array_reverse($historicalWeather['forecast']['forecastday']);
        }

        return $historicalWeather;
    }
}
