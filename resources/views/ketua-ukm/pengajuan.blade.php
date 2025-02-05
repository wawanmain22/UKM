@extends('layouts.ketua')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Pengajuan UKM</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UKM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Wawancara</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengajuanList as $index => $pengajuan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $pengajuan->mahasiswa->nama }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $pengajuan->mahasiswa->nim }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $pengajuan->ukm->nama_ukm }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $pengajuan->alasan_pengajuan }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $pengajuan->tanggal_wawancara ? $pengajuan->tanggal_wawancara->format('d/m/Y H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="showUpdateModal({{ $pengajuan->id }})" 
                                class="text-blue-600 hover:text-blue-900 mr-2">
                            <i class="fas fa-calendar-alt"></i> Set Jadwal
                        </button>
                        @if($pengajuan->tanggal_wawancara)
                        <button onclick="resendEmail({{ $pengajuan->id }})" 
                                class="text-green-600 hover:text-green-900">
                            <i class="fas fa-envelope"></i> Kirim Ulang Email
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Belum ada pengajuan UKM.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Update Jadwal -->
<div id="updateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Set Jadwal Wawancara</h2>
                    <button type="button" onclick="closeUpdateModal()" 
                            class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="updateForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal & Waktu Wawancara</label>
                            <input type="datetime-local" name="tanggal_wawancara" required
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                            @error('tanggal_wawancara')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" 
                                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showUpdateModal(id) {
    document.getElementById('updateForm').action = `/ketua/pengajuan/${id}/update-status`;
    document.getElementById('updateModal').classList.remove('hidden');
}

function closeUpdateModal() {
    document.getElementById('updateModal').classList.add('hidden');
}

function resendEmail(id) {
    if (confirm('Kirim ulang email jadwal wawancara?')) {
        fetch(`/ketua/pengajuan/${id}/resend-email`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Email berhasil dikirim ulang!');
            } else {
                alert('Gagal mengirim ulang email.');
            }
        });
    }
}
</script>
@endpush
@endsection 