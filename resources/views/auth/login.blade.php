@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center justify-center">
                <svg class="h-8 w-8 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Login
            </h1>
            <p class="text-gray-600 mt-2">Masuk untuk mengakses akun kamu</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                        </svg>
                        Email
                    </div>
                </label>
                <input type="email" name="email" id="email" 
                       class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.88 0 1.585-.695 1.585-1.585S12.88 8.83 12 8.83 10.415 9.525 10.415 10.415 11.12 11 12 11z" />
                        </svg>
                        Password
                    </div>
                </label>
                <input type="password" name="password" id="password" 
                       class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       required>
            </div>
            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-gray-700 text-sm">
                    Ingat saya
                </label>
            </div>
            <button type="submit" 
                    class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 transition duration-200 flex items-center justify-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0l4-4m-4 4l4 4" />
                </svg>
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection
