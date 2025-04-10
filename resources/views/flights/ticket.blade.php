@extends('layouts.app')

@section('content')
{{--
HALAMAN DETAIL TIKET PENERBANGAN
==============================
Halaman ini menampilkan daftar tiket/penumpang untuk penerbangan tertentu.
Controller: TicketController@list
Route: /flights/ticket/{id} (name: flights.ticket.list)
--}}

{{-- Header: Menampilkan informasi dasar penerbangan --}}
<h2 class="text-xl font-bold mb-2">Ticket Details for {{ $flight->flight_code }}</h2>
<p class="mb-1">{{ $flight->origin }} → {{ $flight->destination }}</p>
<p class="text-sm mb-4">
    <strong>Departure:</strong> {{ \Carbon\Carbon::parse($flight->departure_time)->translatedFormat('l, d F Y, H:i')
    }}<br>
    <strong>Arrival:</strong> {{ \Carbon\Carbon::parse($flight->arrival_time)->translatedFormat('l, d F Y, H:i') }}
</p>

{{-- Ringkasan jumlah penumpang dan status boarding --}}
<p class="mb-4">
    <strong>{{ $flight->tickets->count() }} passengers</strong> &bull;
    <strong>{{ $flight->tickets->where('is_boarding', true)->count() }} boardings</strong>
</p>

{{-- Tabel daftar tiket/penumpang --}}
<table class="w-full bg-white rounded-xl shadow text-sm">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">No.</th>
            <th class="p-2">Passenger Name</th>
            <th class="p-2">Passenger Phone</th>
            <th class="p-2">Seat Number</th>
            <th class="p-2">Boarding</th>
            <th class="p-2">Delete</th>
            <th class="p-2">Edit</th>

        </tr>
    </thead>
    <tbody>
        {{-- Loop untuk menampilkan setiap tiket dari penerbangan ini --}}
        @foreach ($flight->tickets as $index => $ticket)
        <tr class="border-t">
            <td class="p-2 text-center">{{ $index + 1 }}</td>
            <td class="p-2 text-center">{{ $ticket->passenger_name }}</td>
            <td class="p-2 text-center">{{ $ticket->passenger_phone }}</td>
            <td class="p-2 text-center">{{ $ticket->seat_number }}</td>
            <td class="p-2 text-center">
                {{-- Kondisi: Jika penumpang sudah boarding, tampilkan waktu boarding --}}
                @if ($ticket->is_boarding)
                {{ \Carbon\Carbon::parse($ticket->boarding_time)->format('d-m-Y, H:i') }}
                {{-- Jika belum boarding, tampilkan tombol konfirmasi boarding --}}
                @else
                {{-- Form untuk proses boarding (PUT request ke tickets.board) --}}
                <form action="{{ route('tickets.board', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-gray-600 text-white px-2 py-1 rounded">Confirm</button>
                </form>
                @endif
            </td>
            <td class="p-2 text-center">
                {{-- Kondisi: Tiket hanya bisa dihapus jika belum boarding --}}
                @if (!$ticket->is_boarding)
                {{-- Form untuk menghapus tiket (DELETE request ke tickets.delete) --}}
                <form action="{{ route('tickets.delete', $ticket->id) }}" method="POST"
                    onsubmit="return confirm('Hapus tiket ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                </form>
                @else
                {{-- Jika sudah boarding, tombol delete dinonaktifkan --}}
                <span class="text-gray-400">Delete</span>
                @endif
            </td>
            <td class="p-2 text-center">
                {{-- Kondisi: Tiket hanya bisa dihapus jika belum boarding --}}
                @if (!$ticket->is_boarding)
                {{-- Form untuk menghapus tiket (DELETE request ke tickets.delete) --}}
                <a href="{{ route('tickets.index', $ticket->id) }}" >
                    <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                </a>
                @else
                {{-- Jika sudah boarding, tombol delete dinonaktifkan --}}
                <span class="text-gray-400">Delete</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Navigasi: Tombol kembali ke halaman daftar penerbangan --}}
<div class="mt-6">
    <a href="{{ route('flights.index') }}" class="bg-gray-300 px-4 py-2 rounded">Back</a>
</div>
@endsection