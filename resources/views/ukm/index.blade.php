@extends('layouts.guest')

@section('content')
<div>
    <h1 class="text-3xl font-bold mb-6">Daftar UKM</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($ukms as $ukm)
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold">{{ $ukm->nama_ukm }}</h2>
            <p class="text-gray-600 mt-2">{{ $ukm->deskripsi_ukm }}</p>
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ $ukm->link_sosial_media }}" target="_blank" 
                   class="text-blue-500 hover:underline">
                    <i class="fas fa-external-link-alt mr-1"></i>Sosial Media
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500">
            Belum ada UKM yang terdaftar.
        </div>
        @endforelse
    </div>
</div>
@endsection
