<!-- resources/views/weather/history.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <div class="bg-white p-4 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-2">{{ $city }} Weather History</h1>
            <!-- Display historical weather data here -->
            @foreach ($historicalData as $data)
                <div class="mb-4">
                    <p><strong>Date:</strong> {{ $data['date'] }}</p>
                    <p><strong>Temperature:</strong> {{ $data['temperature'] }}°C</p>
                    <p><strong>Condition:</strong> {{ $data['condition'] }}</p>
                    <!-- Add more data as needed -->
                </div>
            @endforeach
        </div>
    </div>
@endsection
