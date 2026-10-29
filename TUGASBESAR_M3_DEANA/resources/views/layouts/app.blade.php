<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pengelolaan Event - Tiket')</title>
    
    <!-- Memanggil CSS kustom dari folder public -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <!-- Memanggil Bootstrap & Icon via CDN (Opsional jika style.css mu butuh Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: #eaf6ff;">
    <div class="container my-5">
        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success mb-4 text-center shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Konten Halaman Spesifik Akan Masuk ke Sini -->
        @yield('content')
    </div>
</body>
</html>