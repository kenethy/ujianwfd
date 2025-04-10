@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-xl mx-auto">


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

    <form action="{{ route('tickets.edit', $ticket -> id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label class="block">Passenger Name:</label>
            <input type="text" name="passenger_name"
                class="w-full border p-2 rounded @error('passenger_name') border-red-500 @enderror"
                value="{{ old('passenger_name') }}" required>
            @error('passenger_name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- No HP --}}
        <div>
            <label class="block">Passenger Phone:</label>
            <input type="text" name="passenger_phone" maxlength="14"
                class="w-full border p-2 rounded @error('passenger_phone') border-red-500 @enderror"
                value="{{ old('passenger_phone') }}" required>
            @error('passenger_phone')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nomor Kursi --}}
        <div>
            <label class="block">Seat Number:</label>
            <input type="text" name="seat_number" maxlength="3"
                class="w-full border p-2 rounded @error('seat_number') border-red-500 @enderror"
                value="{{ old('seat_number') }}" required>
            @error('seat_number')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
            <a href="{{ route('flights.index') }}" class="bg-gray-300 px-4 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded">Book Ticket</button>
        </div>
    </form>
</div>
@endsection