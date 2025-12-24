@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Oil Change Result</h1>

    <div class="mb-4 p-4 rounded @if($isDue) bg-red-100 text-red-700 @else bg-green-100 text-green-700 @endif">
        @if($isDue)
            <p class="font-semibold">Your car is due for an oil change!</p>
        @else
            <p class="font-semibold">Your car is not due for an oil change yet.</p>
        @endif
    </div>

    <div class="space-y-2">
        <p><strong>Current Odometer:</strong> {{ number_format($oilChange->current_odometer) }} km</p>
        <p><strong>Previous Oil Change Date:</strong> {{ $oilChange->previous_date->format('F jS, Y') }}</p>
        <p><strong>Previous Odometer:</strong> {{ number_format($oilChange->previous_odometer) }} km</p>
    </div>

    <a href="/" class="block mt-6 text-center bg-gray-200 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-300">Check Another Car</a>
@endsection
