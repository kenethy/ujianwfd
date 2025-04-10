<?php

namespace App\Http\Controllers;

// Import class yang dibutuhkan dari Laravel dan model Flight
use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    /**
     * Menampilkan halaman daftar penerbangan (flights).
     *
     * Fungsi ini dipanggil saat pengguna mengakses halaman utama ('/flights').
     * Fungsi ini bertugas mengambil data penerbangan dari database,
     * lalu mengirim data tersebut ke view (tampilan HTML).
     */
    public function index()
    {
        // Mengambil semua data dari tabel "flights" menggunakan Model Flight.
        // Data ini berisi daftar semua penerbangan yang tersimpan di database.
        $flights = Flight::all();

        // Mengirim data yang telah diambil ke file view "flights.index"
        // "compact('flights')" berarti kita mengirim variabel $flights ke tampilan (view).
        // Di dalam view, kita bisa menampilkan data ini dalam bentuk daftar atau tabel.
        return view('flights.index', compact('flights'));
    }
 

    public function newflight (){

        return view('flights.newflight');

    }

    public function submitFlight(Request $request){

        $request->validate([
            'flight_number' => ['required','digits_between:4,7'], // ID penerbangan wajib ada di tabel flights
            'origin' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Nama hanya huruf dan spasi
            'destination' => ['required','regex:/^[a-zA-Z\s]+$/'], // No HP hanya angka, minimal 8 digit, maksimal 14 digit
            'departure_time' => ['required'], // Nomor kursi hanya boleh angka
            'arrival_time' => ['required'], // Nomor kursi hanya boleh angka
        ]);

        Flight::create($request->all());
                
        return redirect()->route('flights.index')->with('success', 'Penerbangan baru berhasil ditambahkan');
    }

    public function indexEditFlight($id){

        $flight = Flight::findOrFail($id);

        return view('flights.editflight', compact('flight'));

    }

    public function flightEdit (Request $request, $id){
        $request->validate([
            'flight_number' => ['required','digits_between:4,7'], // ID penerbangan wajib ada di tabel flights
            'origin' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Nama hanya huruf dan spasi
            'destination' => ['required','regex:/^[a-zA-Z\s]+$/'], // No HP hanya angka, minimal 8 digit, maksimal 14 digit
            'departure_time' => ['required'], // Nomor kursi hanya boleh angka
            'arrival_time' => ['required'], // Nomor kursi hanya boleh angka
        ]);

        $flight = Flight::findorFail($id);

        $flight->update($request->all());


        return redirect()->route('flights.index');
    }

    public function delete($id){
        $flight = Flight::findOrFail($id);

        $flight->delete();

        return redirect()->route('flights.index');

    }
}
