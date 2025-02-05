<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo / Nama Website -->
            <a href="{{ url('/') }}" class="text-xl font-bold">
                {{ config('app.name', 'Website UKM') }}
            </a>

            <!-- Link Navigasi -->
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="hover:text-blue-500">Home</a>
                <a href="{{ route('ukm.index') }}" class="hover:text-blue-500">Daftar UKM</a>
            </div>

            <!-- Tombol Login & Register -->
            <div class="space-x-2">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Register Untuk Mahasiswa</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
