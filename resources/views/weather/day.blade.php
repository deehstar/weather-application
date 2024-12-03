@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">
            {{ \Carbon\Carbon::parse($selectedDay['date'])->format('l, F j, Y') }}
        </h2>

        <!-- Headlines -->
        <div class="grid grid-cols-5 text-gray-500 mb-4 text-center font-semibold">
            <div>Time</div>
            <div>Chance of rain</div>
            <div>Condition</div>
            <div>Temperature</div>
            <div>Feels like</div>
        </div>

        <!-- Forecast Rows -->
        <ul class="space-y-4">
            @foreach ($selectedDay['hour'] as $hour)
                @if (\Carbon\Carbon::parse($hour['time'])->isFuture())
                    <li class="grid grid-cols-5 items-center p-4 rounded-lg shadow-lg bg-white">
                        <div class="text-center">
                            <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($hour['time'])->format('H:i') }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-semibold">{{ $hour['chance_of_rain'] }}%</p>
                        </div>
                        <div class="flex justify-center">
                            <img src="https:{{ $hour['condition']['icon'] }}" alt="Weather Icon" class="w-12 h-12">
                        </div>
                        <div class="text-center">
                            <p class="text-lg">{{ $hour['temp_c'] }}°C</p>
                        </div>
                        <div class="text-center">
                            <p class="text-lg">{{ $hour['feelslike_c'] }}</p>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection
