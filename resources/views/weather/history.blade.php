@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Last 30 days in {{ $city }}</h2>

        <!-- Table Headers -->
        <div class="grid grid-cols-5 text-gray-500 mb-4 text-center font-semibold">
            <div>Date</div>
            <div>Condition</div>
            <div>Max Temp (°C)</div>
            <div>Min Temp (°C)</div>
            <div>Precipitation (mm)</div>
        </div>

        <!-- Weather Data -->
        <ul class="space-y-4">
            @foreach ($processedHistoricalWeather['forecast']['forecastday'] as $day)
                <li class="grid grid-cols-5 items-center p-4 rounded-lg shadow-lg bg-white">
                    <!-- Date -->
                    <div class="text-center">
                        <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($day['date'])->format('l, F j') }}</p>
                    </div>

                    <!-- Weather Condition -->
                    <div class="flex flex-col items-center">
                        <img src="https:{{ $day['day']['condition']['icon'] }}" alt="Condition Icon" class="w-12 h-12">
                    </div>

                    <!-- Max Temperature -->
                    <div class="text-center">
                        <p class="text-lg">{{ $day['day']['maxtemp_c'] }}°C</p>
                    </div>

                    <!-- Min Temperature -->
                    <div class="text-center">
                        <p class="text-lg">{{ $day['day']['mintemp_c'] }}°C</p>
                    </div>

                    <!-- Precipitation -->
                    <div class="text-center">
                        <p class="text-lg">{{ $day['day']['totalprecip_mm'] }} mm</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
