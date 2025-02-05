@extends('layouts.ketua')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Informasi UKM</h1>
        <button onclick="document.getElementById('tambahUKMModal').classList.remove('hidden')" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah UKM
        </button>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Tabel UKM -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama UKM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link Sosial Media</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($ukm as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $item->nama_ukm }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            {{ Str::limit($item->deskripsi_ukm, 100) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ $item->link_sosial_media }}" target="_blank" 
                           class="text-blue-500 hover:text-blue-700 text-sm">
                            <i class="fas fa-external-link-alt mr-1"></i> Link
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-2">
                            <button data-ukm-id="{{ $item->id }}" 
                                    class="edit-ukm-btn text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('ukm.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus UKM ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada UKM yang terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah UKM -->
<div id="tambahUKMModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Tambah UKM Baru</h2>
                    <button onclick="document.getElementById('tambahUKMModal').classList.add('hidden')" 
                            class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('ukm.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Nama UKM</label>
                            <input type="text" name="nama_ukm" required
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi_ukm" required rows="4"
                                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Link Sosial Media</label>
                            <input type="text" name="link_sosial_media" required
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                        </div>
                        <button type="submit" 
                                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                            Simpan UKM
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit UKM -->
<div id="editUKMModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Edit UKM</h2>
                    <button data-modal-close="editUKMModal" 
                            class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="editUKMForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Nama UKM</label>
                            <input type="text" name="nama_ukm" id="edit_nama_ukm" required
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi_ukm" id="edit_deskripsi_ukm" required rows="4"
                                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Link Sosial Media</label>
                            <input type="text" name="link_sosial_media" id="edit_link_sosial_media" required
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                        </div>
                        <button type="submit" 
                                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                            Update UKM
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Tunggu sampai DOM selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua tombol edit
        const editButtons = document.querySelectorAll('.edit-ukm-btn');
        const ukm = @json($ukm);

        // Tambahkan event listener ke setiap tombol
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = parseInt(this.dataset.ukmId);
                const selectedUKM = ukm.find(item => item.id === id);
                
                if (selectedUKM) {
                    document.getElementById('edit_nama_ukm').value = selectedUKM.nama_ukm;
                    document.getElementById('edit_deskripsi_ukm').value = selectedUKM.deskripsi_ukm;
                    document.getElementById('edit_link_sosial_media').value = selectedUKM.link_sosial_media;
                    
                    document.getElementById('editUKMForm').action = `/ukm/${id}`;
                    document.getElementById('editUKMModal').classList.remove('hidden');
                }
            });
        });

        // Tambahkan event listener untuk tombol close modal
        const closeButtons = document.querySelectorAll('[data-modal-close]');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.dataset.modalClose;
                document.getElementById(modalId).classList.add('hidden');
            });
        });
    });
</script>
@endpush
@endsection
