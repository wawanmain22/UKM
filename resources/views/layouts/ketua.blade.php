<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ketua UKM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="p-4">
                <h2 class="text-2xl font-bold text-gray-800">UKM Panel</h2>
            </div>
            <nav class="mt-4">
                <a href="{{ route('ketua.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-blue-500 hover:text-white {{ request()->routeIs('ketua.dashboard') ? 'bg-blue-500 text-white' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('ketua.ukm') }}" class="block px-4 py-2 text-gray-600 hover:bg-blue-500 hover:text-white {{ request()->routeIs('ketua.ukm') ? 'bg-blue-500 text-white' : '' }}">
                    UKM
                </a>
                <a href="{{ route('ketua.pengajuan') }}" class="block px-4 py-2 text-gray-600 hover:bg-blue-500 hover:text-white {{ request()->routeIs('ketua.pengajuan') ? 'bg-blue-500 text-white' : '' }}">
                    Daftar Pengajuan
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow-md p-4">
                <div class="flex justify-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Tambahkan ini di bagian bawah sebelum closing body tag -->
    <script>
        // Base scripts
    </script>
    @stack('scripts')
</body>
</html>
