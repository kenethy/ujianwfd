<?php

// Mendefinisikan lokasi namespace (alamat folder Controller ini)
namespace App\Http\Controllers;

// Mengimport model Flight dari folder app/Models/Flight.php
use App\Models\Flight;

// Mengimport model Ticket dari folder app/Models/Ticket.php
use App\Models\Ticket;

// Mengimport Request (untuk menangani input user dari form)
use Illuminate\Http\Request;

// Controller ini bertugas mengelola semua logika terkait Tiket (pemesanan, boarding, penghapusan, dll.)
class TicketController extends Controller
{
    /**
     * Menampilkan form untuk memesan tiket penerbangan tertentu.
     *
     * Fungsi ini dipanggil saat URL /flights/book/{id} diakses.
     * Contoh URL: /flights/book/1
     *
     * @param int $id (ID penerbangan yang akan dipesan tiketnya)
     */
    public function book($id)
    {
        // Mengambil data penerbangan dari tabel "flights" berdasarkan ID.
        // Jika data tidak ditemukan, Laravel otomatis menampilkan halaman error 404.
        $flight = Flight::findOrFail($id);

        // Menampilkan halaman form booking (resources/views/flights/book.blade.php)
        // dan mengirim data penerbangan ke halaman tersebut.
        return view('flights.book', compact('flight'));
    }

    public function editIndex($id)
    {
        // Mengambil data penerbangan dari tabel "flights" berdasarkan ID.
        // Jika data tidak ditemukan, Laravel otomatis menampilkan halaman error 404.
        $ticket = Ticket::findOrFail($id);

        // Menampilkan halaman form booking (resources/views/flights/book.blade.php)
        // dan mengirim data penerbangan ke halaman tersebut.
        return view('flights.editticket', compact('ticket'));
    }

    /**
     * Menyimpan data tiket baru ke database setelah form disubmit.
     *
     * Fungsi ini menerima input user dari form di halaman booking tiket.
     *
     * @param Request $request (berisi data yang di-input user)
     */
    public function submit(Request $request)
    {
        // Validasi input pengguna sesuai aturan sebelum menyimpan ke database
        $request->validate([
            'flight_id' => 'required|exists:flights,id', // ID penerbangan wajib ada di tabel flights
            'passenger_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Nama hanya huruf dan spasi
            'passenger_phone' => ['required', 'digits_between:8,14'], // No HP hanya angka, minimal 8 digit, maksimal 14 digit
            'seat_number' => ['required', 'numeric'], // Nomor kursi hanya boleh angka
        ]);

        // Menyimpan data tiket baru ke tabel "tickets" menggunakan model Ticket
        Ticket::create([
            'flight_id' => $request->flight_id,
            'passenger_name' => $request->passenger_name,
            'passenger_phone' => $request->passenger_phone,
            'seat_number' => $request->seat_number,
            'is_boarding' => false, // Default tiket belum boarding
        ]);

        // Setelah data berhasil disimpan, redirect user ke halaman utama daftar penerbangan
        // (routes/web.php -> route dengan nama flights.index)
        return redirect()->route('flights.index')->with('success', 'Tiket berhasil dipesan!');
    }

    /**
     * Menampilkan daftar tiket (penumpang) dari penerbangan tertentu.
     *
     * Fungsi ini dijalankan ketika user mengakses URL: /flights/ticket/{id}
     *
     * @param int $id (ID penerbangan)
     */
    public function list($id)
    {
        // Mengambil data penerbangan sekaligus data tiket-tiket yang terkait dengannya.
        $flight = Flight::with('tickets')->findOrFail($id);

        // Menampilkan halaman detail tiket dari penerbangan
        // Lokasi view: resources/views/flights/ticket.blade.php
        return view('flights.ticket', compact('flight'));
    }

    /**
     * Mengubah status tiket penumpang menjadi "boarding".
     *
     * Fungsi ini dipanggil saat user menekan tombol konfirmasi boarding di halaman tiket.
     * URL aksi: /tickets/board/{id} (method PUT)
     *
     * @param int $id (ID tiket yang ingin diubah status boarding-nya)
     */
    public function board($id)
    {
        // Mengambil data tiket dari tabel "tickets" berdasarkan ID
        $ticket = Ticket::findOrFail($id);

        // Mengubah status tiket menjadi "sudah boarding" dan mencatat waktu boarding
        $ticket->is_boarding = true;
        $ticket->boarding_time = now(); // Mengambil waktu sekarang (current timestamp)
        $ticket->save(); // Simpan perubahan ke database

        // Kembali ke halaman sebelumnya dengan pesan sukses boarding
        return back()->with('success', 'Penumpang telah boarding.');
    }

    /**
     * Menghapus tiket penumpang dari database.
     *
     * Fungsi ini dipanggil saat user mengklik tombol hapus tiket di halaman tiket.
     * URL aksi: /tickets/delete/{id} (method DELETE)
     *
     * Tiket hanya bisa dihapus jika statusnya belum boarding.
     *
     * @param int $id (ID tiket yang ingin dihapus)
     */
    public function delete($id)
    {
        // Mengambil data tiket berdasarkan ID-nya
        $ticket = Ticket::findOrFail($id);

        // Cek apakah tiket sudah boarding, jika iya, tidak boleh dihapus
        if ($ticket->is_boarding) {
            // Kembali ke halaman sebelumnya dengan pesan error
            return back()->with('error', 'Tiket sudah boarding, tidak bisa dihapus.');
        }

        // Jika tiket belum boarding, hapus tiket tersebut dari database
        $ticket->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses tiket berhasil dihapus
        return back()->with('success', 'Tiket berhasil dihapus.');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'passenger_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Nama hanya huruf dan spasi
            'passenger_phone' => ['required', 'digits_between:8,14'], // No HP hanya angka, minimal 8 digit, maksimal 14 digit
            'seat_number' => ['required', 'numeric'], // Nomor kursi hanya boleh angka
        ]);

        //buatkan spesifik mau change apa kalo edit karena taktunya foreign key nya ke update

        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'passenger_name' => $request->passenger_name,
            'passenger_phone' => $request->passenger_phone,
            'seat_number' => $request->seat_number,
        ]);

        return redirect()->route('flights.index');
    }
}
