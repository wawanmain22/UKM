@extends('layouts.guest')

@section('content')
<div class="max-w-4xl mx-auto text-center">
    <!-- Judul dengan ikon -->
    <h1 class="text-4xl font-bold mb-4 flex items-center justify-center">
        <svg class="h-10 w-10 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Selamat Datang di Website UKM
    </h1>
    
    <!-- Deskripsi singkat -->
    <p class="text-lg mb-6">
        Temukan wadah kreativitas dan pengembangan diri melalui UKM (Unit Kegiatan Mahasiswa) di kampus kita.
        UKM adalah tempat untuk menyalurkan minat, mengasah bakat, dan mengembangkan potensi diri secara profesional serta membangun jejaring yang bermanfaat.
    </p>
    
    <!-- Quote Inspiratif -->
    <blockquote class="bg-gray-100 border-l-4 border-blue-500 italic text-gray-600 p-4 mb-6">
        <svg class="inline-block h-6 w-6 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.049 2.927C9.569 2.042 10.431 2.042 10.951 2.927l1.805 3.63 4.006.58c.97.14 1.357 1.332.655 2.018l-2.899 2.826.684 3.984c.166.966-.85 1.701-1.716 1.246L10 15.347l-3.57 1.877c-.866.455-1.882-.28-1.716-1.246l.684-3.984L2.599 9.165c-.702-.686-.315-1.878.655-2.018l4.006-.58 1.805-3.63z"/>
        </svg>
        "Berkarya di UKM bukan hanya soal mengasah kemampuan, tapi juga membangun karakter dan mewujudkan perubahan positif." 
        <span class="block mt-2 text-right text-sm">– Alumni UKM</span>
    </blockquote>
    
    <!-- Manfaat Bergabung dengan UKM -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-2 flex items-center justify-center">
            <svg class="h-8 w-8 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Mengapa Bergabung dengan UKM?
        </h2>
        <p class="mb-4">
            Bergabung dengan UKM memberikan berbagai manfaat, antara lain:
        </p>
        <ul class="text-left mx-auto max-w-md space-y-2">
            <li class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Mengasah keterampilan dan kreativitas.
            </li>
            <li class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Membangun relasi dan jejaring pertemanan.
            </li>
            <li class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Mendapatkan pengalaman organisasi yang berharga.
            </li>
            <li class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Berkontribusi dalam kegiatan sosial dan pengembangan kampus.
            </li>
        </ul>
    </div>
    
    <!-- Tombol Aksi -->
    <div class="mt-8">
        <a href="{{ route('ukm.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            Lihat Daftar UKM
        </a>
    </div>
</div>
@endsection
