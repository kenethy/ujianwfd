<?php

// Import class Route dari Laravel untuk mendefinisikan route (alamat URL)
use Illuminate\Support\Facades\Route;

// Mengimport Controller yang akan digunakan di setiap route
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini berisi definisi route untuk aplikasi web. Setiap route
| akan menentukan URL yang diakses pengguna, dan akan diarahkan
| ke Controller serta method tertentu yang menangani logika aplikasinya.
|
*/

// Route halaman utama ('/') menampilkan daftar penerbangan
// Menggunakan method "index" pada FlightController
Route::get('/', [FlightController::class, 'index'])->name('flights.index');

// Route tambahan (opsional): URL '/flights' juga menampilkan daftar penerbangan
// Sama dengan route di atas, menggunakan method "index" FlightController
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');

// Route menampilkan halaman form booking tiket dari penerbangan tertentu
// Parameter "{id}" akan berisi ID penerbangan yang dipilih user (contoh: /flights/book/1)
// Ditangani oleh method "book" pada TicketController
Route::get('/flights/book/{id}', [TicketController::class, 'book'])->name('flights.book');

// Route yang menangani proses submit data form pemesanan tiket (saat tombol submit ditekan)
// Menggunakan HTTP method POST (karena ada data yang dikirim dari form)
// Ditangani oleh method "submit" pada TicketController
Route::post('/tickets/submit', [TicketController::class, 'submit'])->name('tickets.submit'); //alias untuk di views nya

// Route menampilkan daftar tiket (penumpang) dari penerbangan tertentu
// Parameter "{id}" adalah ID penerbangan (contoh: /flights/ticket/1)
// Ditangani oleh method "list" pada TicketController
Route::get('/flights/ticket/{id}', [TicketController::class, 'list'])->name('flights.ticket.list');

// Route untuk proses konfirmasi boarding penumpang
// Menggunakan HTTP method PUT karena ini merupakan proses update data
// Parameter "{id}" adalah ID tiket yang akan boarding
// Ditangani oleh method "board" pada TicketController
Route::put('/tickets/board/{id}', [TicketController::class, 'board'])->name('tickets.board');

// Route untuk menghapus tiket tertentu
// Menggunakan HTTP method DELETE karena menghapus data
// Parameter "{id}" adalah ID tiket yang akan dihapus
// Ditangani oleh method "delete" pada TicketController
Route::delete('/tickets/delete/{id}', [TicketController::class, 'delete'])->name('tickets.delete');

Route::get('/newflight',[FlightController::class, 'newflight'])->name('new.flight');

Route::post('/newflight/submit', [FlightController::class, 'submitFlight'])->name('flight.submit');

Route::get('/flights/edit/{id}', [FlightController::class, 'indexEditFlight'])->name('flights.edit.page');

Route::put('/flights/editing/{id}', [FlightController::class, 'flightEdit'])->name('flights.edit');

Route::delete('/flights/delete/{id}',[FlightController::class, 'delete'])->name('flights.delete');

Route::get('/tickets/editing/page/{id}',[TicketController::class, 'editIndex'])->name('tickets.index');

Route::put('/tickets/editing/{id}', [TicketController::class, 'edit'])->name('tickets.edit');

