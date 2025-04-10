<?php

// Mendefinisikan namespace (lokasi file Ticket.php) dalam struktur folder Laravel
namespace App\Models;

// Mengimport fitur HasFactory yang memudahkan membuat data dummy/test (opsional)
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Mengimport class Model utama dari Laravel untuk memanfaatkan fitur Eloquent ORM
use Illuminate\Database\Eloquent\Model;

/**
 * Model Ticket merepresentasikan tabel 'tickets' di database.
 *
 * Model ini bertugas menangani segala bentuk interaksi dengan tabel 'tickets', 
 * seperti penambahan, pengubahan, penghapusan, dan pencarian data tiket.
 */
class Ticket extends Model
{
    // Menggunakan fitur HasFactory (opsional),
    // agar kita dapat membuat data dummy dengan mudah menggunakan Laravel Factory.
    use HasFactory;

    // Menentukan nama tabel yang dihubungkan dengan model ini.
    // Jika tidak ditulis, Laravel otomatis menggunakan nama jamak dari nama Model (Ticket → tickets).
    protected $table = 'tickets';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     *
     * Hanya kolom yang disebutkan di sini yang boleh diisi secara otomatis menggunakan
     * metode seperti Ticket::create([...]) atau Ticket::update([...]).
     */
    protected $fillable = [
        'flight_id',        // Kolom foreign key yang mengacu pada penerbangan tertentu
        'passenger_name',   // Nama penumpang yang membeli tiket
        'passenger_phone',  // Nomor HP penumpang (8-14 digit angka)
        'seat_number',      // Nomor kursi penumpang (hanya angka)
        'is_boarding',      // Status apakah penumpang sudah boarding (true) atau belum (false)
        'boarding_time'     // Waktu saat penumpang boarding (nullable)
    ];

    /**
     * Mendefinisikan hubungan (relasi) Many-to-One dengan model Flight.
     *
     * Artinya, satu tiket hanya berhubungan dengan satu penerbangan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flight()
    {
        // Relasi ini menunjukkan bahwa setiap tiket "milik" satu penerbangan
        // Menggunakan kolom 'flight_id' di tabel 'tickets'
        // yang merujuk ke kolom 'id' di tabel 'flights'.
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }
}
