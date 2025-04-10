@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit Plane Schedule </h2>

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

    <form action="{{ route('flights.edit', $flight->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="hidden" name="flight_id">

        {{-- Nama --}}
        <div>
            <label class="block">Flight Number:</label>
            <input type="text" name="flight_number" class="w-full border p-2 rounded" value="{{ old('flight_number', $flight->flight_number) }}" required>
            
        </div>

        {{-- No HP --}}
        <div>
            <label class="block">Flight Origin:</label>
            <input type="text" name="origin" value="{{ old('origin', $flight->origin) }}" maxlength="3" class="w-full border p-2 rounded @error('passenger_phone') border-red-500 @enderror" value="{{ old('passenger_phone') }}" required>
            @error('passenger_phone')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nomor Kursi --}}
        <div>
            <label class="block">Flight Destination:</label>
            <input type="text" name="destination" value="{{ $flight->destination }}" maxlength="3" class="w-full border p-2 rounded @error('seat_number') border-red-500 @enderror" value="{{ old('seat_number') }}" required>
            @error('seat_number')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block">Departure Time:</label>
            <input type="datetime-local" value="{{ $flight->departure_time }}" name="departure_time" class="w-full border p-2 rounded" required>
            @error('seat_number')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block">Arrival Time:</label>
            <input type="datetime-local" value="{{ $flight->arrival_time }}" name="arrival_time" class="w-full border p-2 rounded" required>
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
