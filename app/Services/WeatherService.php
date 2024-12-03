<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Log;
use App\Models\Location;

class WeatherService
{
    /**
     * Create a new class instance.
     */
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {

    }

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

}
