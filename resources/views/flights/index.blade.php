{{-- Menggunakan layout utama 'app.blade.php' yang berada di resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Menandai bahwa isi dari @section('content') akan ditampilkan di bagian @yield('content') pada layout --}}
@section('content')

{{-- Membuat grid responsive untuk menampilkan card penerbangan (1 kolom di mobile, 2 di tablet, 3 di desktop) --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    
{{-- Melakukan perulangan pada variabel $flights yang dikirim dari controller --}}
    
@foreach ($flights as $flight)

    {{-- Membuat card untuk setiap penerbangan --}}
    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
        <div class = "flex justify-end">
            <form action="{{ route('flights.delete', $flight->id) }}" method="POST" onsubmit="return confirm('Hapus tiket ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">X</button>
            </form>
        </div>
        
        {{-- Menampilkan kode penerbangan (contoh: JT610) --}}
        <h2 class="text-xl font-bold mb-1">{{ $flight->flight_number }}</h2>

        {{-- Menampilkan kota asal dan kota tujuan penerbangan (contoh: SUB → CGK) --}}
        <p>{{ $flight->origin }} → {{ $flight->destination }}</p>

        {{-- Menampilkan informasi waktu keberangkatan dan kedatangan --}}
        <p class="text-sm mt-2">
            {{-- Departure time diformat agar tampil rapi, misalnya: Senin, 01 Januari 2024, 13:00 --}}
            <strong>Departure:</strong> {{ \Carbon\Carbon::parse($flight->departure_time)->translatedFormat('l, d F Y, H:i') }}<br>
            
            {{-- Arrival time juga diformat serupa --}}
            <strong>Arrival:</strong> {{ \Carbon\Carbon::parse($flight->arrival_time)->translatedFormat('l, d F Y, H:i') }}
        </p>

        {{-- Tombol aksi di bagian bawah card --}}
        <div class="mt-4 flex justify-between gap-2">
            
            {{-- Tombol untuk memesan tiket (link ke form booking) --}}
            {{-- Route ini akan menjalankan method 'book' pada TicketController --}}
            <a href="{{ route('flights.book', $flight->id) }}" 
               class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded shadow">
               Book Ticket
            </a>

            {{-- Tombol untuk melihat daftar tiket dari flight ini --}}
            {{-- Route ini akan menjalankan method 'list' pada TicketController --}}
            <a href="{{ route('flights.ticket.list', $flight->id) }}" 
               class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded shadow">
               View Details
            </a>

            <a href="{{ route('flights.edit.page', $flight->id) }}" 
                class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded shadow">
                Edit
             </a>

             
        </div>
    </div>

    {{-- Akhir dari loop per flight --}}
    @endforeach

</div>

<div class = "flex justify-end">

    <a href="{{ route('new.flight') }}" class = "bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded shadow text-2xl"> +

    </a>

</div>

{{-- Akhir dari section content --}}
@endsection
