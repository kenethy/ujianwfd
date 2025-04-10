@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">New Plane Schedule </h2>

    {{-- Alert error jika ada --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <strong>Periksa kembali form anda:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('flight.submit') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="flight_id">

        {{-- Nama --}}
        <div>
            <label class="block">Flight Number:</label>
            <input type="text" name="flight_number" class="w-full border p-2 rounded" required>
            
        </div>

        {{-- No HP --}}
        <div>
            <label class="block">Flight Origin:</label>
            <input type="text" name="origin" maxlength="3" class="w-full border p-2 rounded @error('passenger_phone') border-red-500 @enderror" value="{{ old('passenger_phone') }}" required>
            @error('passenger_phone')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nomor Kursi --}}
        <div>
            <label class="block">Flight Destination:</label>
            <input type="text" name="destination" maxlength="3" class="w-full border p-2 rounded @error('seat_number') border-red-500 @enderror" value="{{ old('seat_number') }}" required>
            @error('seat_number')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block">Departure Time:</label>
            <input type="datetime-local" name="departure_time" class="w-full border p-2 rounded" required>
            @error('seat_number')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block">Arrival Time:</label>
            <input type="datetime-local" name="arrival_time" class="w-full border p-2 rounded" required>
            @error('seat_number')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
            <a href="{{ route('flights.index') }}" class="bg-gray-300 px-4 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded">Flight!</button>
        </div>
    </form>
</div>
@endsection
