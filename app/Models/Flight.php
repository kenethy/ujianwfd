<?php

// Mendefinisikan namespace (alamat lokasi) Model ini dalam struktur aplikasi Laravel
namespace App\Models;

// Mengimport fitur HasFactory untuk memudahkan membuat data dummy (optional)
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Mengimport class utama Model dari Laravel Eloquent
use Illuminate\Database\Eloquent\Model;

/**
 * Model Flight ini merepresentasikan tabel 'flights' di database.
 *
 * Setiap data penerbangan akan menggunakan model ini untuk
 * melakukan operasi (seperti tambah, edit, hapus, atau ambil data).
 */
class Flight extends Model
{
    // Menggunakan fitur HasFactory (optional),
    // supaya bisa menggunakan Factory Laravel (untuk membuat data dummy/test)
    use HasFactory;

    // Menentukan nama tabel yang dihubungkan dengan model ini di database.
    // Laravel otomatis akan mencari tabel 'flights', jadi baris ini bersifat opsional.
    protected $table = 'flights';

    /**
     * Mendefinisikan kolom mana saja yang boleh diisi secara massal (Mass Assignment).
     *
     * Kolom-kolom ini adalah kolom yang boleh diisi melalui method seperti Flight::create([...]).
     */     
    protected $fillable = [
        'flight_number',      // Kode penerbangan (contoh: JT610, GA205)
        'origin',           // Kota/bandara asal penerbangan (contoh: SUB, CGK)
        'destination',      // Kota/bandara tujuan penerbangan (contoh: DPS, SIN)
        'departure_time',   // Waktu keberangkatan penerbangan
        'arrival_time'      // Waktu kedatangan penerbangan
    ];

    /**
     * Mendefinisikan relasi "One-to-Many" dengan model Ticket.
     *
     * Artinya, satu penerbangan (flight) bisa memiliki banyak tiket penumpang.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        // Menunjukkan bahwa model Flight ini memiliki relasi One-to-Many
        // dengan model Ticket, menggunakan kolom 'flight_id' di tabel 'tickets'
        // yang mengacu pada kolom 'id' di tabel 'flights' (model ini).
        return $this->hasMany(Ticket::class, 'flight_id', 'id');
    }
}
