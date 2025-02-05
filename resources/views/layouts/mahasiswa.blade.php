<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa - UKM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="p-4">
                <h2 class="text-2xl font-bold text-gray-800">Portal UKM</h2>
            </div>
            <nav class="mt-4">
                <a href="{{ route('mahasiswa.daftarukm') }}" 
                   class="block px-4 py-2 text-gray-600 hover:bg-blue-500 hover:text-white 
                   {{ request()->routeIs('mahasiswa.daftarukm') ? 'bg-blue-500 text-white' : '' }}">
                    <i class="fas fa-list-alt mr-2"></i>Daftar UKM
                </a>
                <a href="{{ route('mahasiswa.pengajuan') }}" 
                   class="block px-4 py-2 text-gray-600 hover:bg-blue-500 hover:text-white 
                   {{ request()->routeIs('mahasiswa.pengajuan') ? 'bg-blue-500 text-white' : '' }}">
                    <i class="fas fa-paper-plane mr-2"></i>Pengajuan Saya
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow-md p-4">
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">
                        Welcome, {{ auth()->user()->mahasiswa->nama }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
