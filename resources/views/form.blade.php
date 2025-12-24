@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">
            Vehikl Oil Change Checker
        </h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <p class="font-semibold mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('oil.change.check') }}" class="space-y-6">
            @csrf

            <div>
                <label for="current_odometer" class="block text-sm font-medium text-gray-700 mb-1">
                    Current Odometer (km)
                </label>
                <input
                    type="number"
                    name="current_odometer"
                    id="current_odometer"
                    value="{{ old('current_odometer') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_odometer') border-red-500 @enderror"
                    required
                >
                @error('current_odometer')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="previous_date" class="block text-sm font-medium text-gray-700 mb-1">
                    Date of Previous Oil Change
                </label>
                <input
                    type="date"
                    name="previous_date"
                    id="previous_date"
                    value="{{ old('previous_date') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('previous_date') border-red-500 @enderror"
                    required
                >
                @error('previous_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="previous_odometer" class="block text-sm font-medium text-gray-700 mb-1">
                    Odometer at Previous Oil Change (km)
                </label>
                <input
                    type="number"
                    name="previous_odometer"
                    id="previous_odometer"
                    value="{{ old('previous_odometer') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('previous_odometer') border-red-500 @enderror"
                    required
                >
                @error('previous_odometer')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200"
                >
                    Check Oil Change Status
                </button>
            </div>
        </form>
    </div>
@endsection
