<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bagian head: Informasi dasar dokumen HTML -->

    <!-- Menentukan tipe encoding karakter -->
    <meta charset="UTF-8">

    <!-- Judul website yang muncul di tab browser -->
    <title>Airline System</title>

    <!-- Memuat file CSS yang dikompilasi oleh Vite (Tailwind CSS) -->
    <!-- File ini berasal dari 'resources/css/app.css' yang sudah dikompilasi -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <!-- 
        Bagian body:
        Menampilkan seluruh konten aplikasi, termasuk komponen header, content utama, dan footer.
    -->

    <!-- Memuat komponen Header (terletak di 'resources/views/components/header.blade.php') -->
    <x-header />

    <!-- Bagian utama dari setiap halaman -->
    <!-- Setiap halaman akan menampilkan kontennya di bagian ini -->
    <main class="max-w-6xl mx-auto p-6">
         <!-- adalah tempat di mana konten spesifik halaman akan ditampilkan -->
        @yield('content')
    </main>

    <!-- Memuat komponen Footer (terletak di 'resources/views/components/footer.blade.php') -->
    <x-footer />
</body>
</html>
