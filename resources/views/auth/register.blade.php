@extends('layouts.guest')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-lg rounded p-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Register Untuk Mahasiswa</h1>

    {{-- Notifikasi Success --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Notifikasi Error --}}
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Oops!</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Data Akun -->
        <fieldset class="mb-6">
            <legend class="text-lg font-semibold text-gray-700 mb-4">Data Akun</legend>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                    </svg>
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="mt-1 w-full border @error('email') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.88 0 1.585-.695 1.585-1.585S12.88 8.83 12 8.83 10.415 9.525 10.415 10.415 11.12 11 12 11z" />
                    </svg>
                    Password
                </label>
                <input type="password" name="password" id="password"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.88 0 1.585-.695 1.585-1.585S12.88 8.83 12 8.83 10.415 9.525 10.415 10.415 11.12 11 12 11z" />
                    </svg>
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>
        </fieldset>

        <!-- Data Mahasiswa -->
        <fieldset class="mb-6">
            <legend class="text-lg font-semibold text-gray-700 mb-4">Data Mahasiswa</legend>
            <div class="mb-4">
                <label for="nim" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                    </svg>
                    NIM
                </label>
                <input type="text" name="nim" id="nim"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.992 4.992 0 0012 20a4.992 4.992 0 006.879-2.196M12 12a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    Nama Lengkap
                </label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="kelas" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" />
                    </svg>
                    Kelas
                </label>
                <input type="text" name="kelas" id="kelas"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="angkatan" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 010 8H8a4 4 0 010-8h8z" />
                    </svg>
                    Angkatan
                </label>
                <input type="number" name="angkatan" id="angkatan"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="semester" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    Semester
                </label>
                <input type="number" name="semester" id="semester"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="program_studi" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h10" />
                    </svg>
                    Program Studi
                </label>
                <input type="text" name="program_studi" id="program_studi"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="fakultas" class="block text-gray-700 flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18M3 15h18" />
                    </svg>
                    Fakultas
                </label>
                <input type="text" name="fakultas" id="fakultas"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>
        </fieldset>

        <div>
            <button type="submit"
                class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200">
                Register
            </button>
        </div>
    </form>
</div>
@endsection
