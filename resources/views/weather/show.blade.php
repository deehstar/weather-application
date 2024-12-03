<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather in {{ $currentWeather['location']['name'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6 space-y-6">
        <!-- Current Weather Section -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">{{ $currentLocation['name'] }}</h1>
                <p class="text-xl text-gray-600">{{ $currentLocation['region'] }},
                    {{ $currentWeather['location']['country'] }}</p>
                <p class="text-5xl font-semibold mt-4">{{ $currentWeather['temp_c'] }}°C</p>
                <p class="text-lg text-gray-600">{{ $currentWeather['condition_text'] }}</p>
            </div>
            <div>
                <img src="https:{{ $currentWeather['condition_icon'] }}" alt="Weather Icon" class="w-32 h-32">
            </div>

        </div>

        <!-- 7-Day Forecast Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">7-Day Forecast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @foreach ($forecastData['forecast']['forecastday'] as $day)
                    <a href="{{ route('weather.day', ['city' => $currentWeather['location']['name'], 'date' => $day['date']]) }}"
                        class="transform transition duration-300 hover:scale-105">
                        <div class="bg-gray-100 p-4 rounded-lg shadow hover:bg-gray-200">
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($day['date'])->isToday() ? 'Today' : \Carbon\Carbon::parse($day['date'])->format('D, M j') }}
                            </p>
                            <img src="https:{{ $day['day']['condition']['icon'] }}" alt="Weather Icon"
                                class="w-12 h-12 mx-auto my-2">
                            <p class="text-center">{{ $day['day']['avgtemp_c'] }}°C</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection


</html>
