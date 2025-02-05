@extends('layouts.ketua')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Statistik Card -->
        <div class="bg-blue-500 text-white rounded-lg p-4">
            <h3 class="text-lg font-semibold">Total Pengajuan</h3>
            <p class="text-3xl font-bold">{{ $totalPengajuanPending + $totalPengajuanTerjadwal }}</p>
            <p class="text-sm mt-2">Total Semua Pengajuan</p>
        </div>

        <div class="bg-yellow-500 text-white rounded-lg p-4">
            <h3 class="text-lg font-semibold">Belum Terjadwal</h3>
            <p class="text-3xl font-bold">{{ $totalPengajuanPending }}</p>
            <p class="text-sm mt-2">Menunggu Jadwal Wawancara</p>
        </div>

        <div class="bg-green-500 text-white rounded-lg p-4">
            <h3 class="text-lg font-semibold">Sudah Terjadwal</h3>
            <p class="text-3xl font-bold">{{ $totalPengajuanTerjadwal }}</p>
            <p class="text-sm mt-2">Sudah Ada Jadwal Wawancara</p>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h2>
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="space-y-4">
                @forelse($aktivitasTerbaru as $aktivitas)
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                    <div>
                        <p class="text-gray-800">
                            Pengajuan dari {{ $aktivitas->mahasiswa->nama }} untuk UKM {{ $aktivitas->ukm->nama_ukm }}
                        </p>
                        <p class="text-sm text-gray-500">{{ $aktivitas->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-gray-500 text-center">Belum ada aktivitas</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Pengajuan Terbaru -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Pengajuan Terbaru</h2>
        <div class="bg-white border rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">UKM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jadwal Wawancara</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pengajuanTerbaru as $pengajuan)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengajuan->mahasiswa->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengajuan->mahasiswa->nim }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengajuan->ukm->nama_ukm }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengajuan->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($pengajuan->tanggal_wawancara)
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                    {{ $pengajuan->tanggal_wawancara->format('d M Y H:i') }}
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                    Belum Terjadwal
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada pengajuan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
