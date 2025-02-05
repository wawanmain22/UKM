@extends('layouts.mahasiswa')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Unit Kegiatan Mahasiswa (UKM)</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($ukms as $ukm)
        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $ukm->nama_ukm }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($ukm->deskripsi_ukm, 150) }}</p>
                
                <div class="flex items-center text-gray-500 mb-4">
                    <i class="fas fa-users mr-2"></i>
                    <span>{{ $ukm->pendaftaranUKM->count() }} Anggota</span>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ $ukm->link_sosial_media }}" target="_blank" 
                       class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-external-link-alt mr-1"></i>Sosial Media
                    </a>
                    
                    @if($ukm->pendaftaranUKM->where('mahasiswa_id', auth()->user()->mahasiswa->id)->first())
                        @if($ukm->pendaftaranUKM->where('mahasiswa_id', auth()->user()->mahasiswa->id)->first()->status === 'pending')
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg text-sm">
                                Menunggu Persetujuan
                            </span>
                        @else
                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm">
                                Sudah Terdaftar
                            </span>
                        @endif
                    @else
                        <button onclick="showPengajuanModal({{ $ukm->id }}, '{{ $ukm->nama_ukm }}')" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                            Ajukan Pendaftaran
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Pengajuan -->
<div id="pengajuanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Pengajuan UKM <span id="namaUKM"></span></h2>
                    <button type="button" onclick="document.getElementById('pengajuanModal').classList.add('hidden')" 
                            class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="formPengajuan" method="POST" action="">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Alasan Pengajuan</label>
                            <textarea name="alasan_pengajuan" required rows="4"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 @error('alasan_pengajuan') border-red-500 @enderror"
                                    placeholder="Jelaskan alasan Anda ingin bergabung dengan UKM ini..."></textarea>
                            @error('alasan_pengajuan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" 
                                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showPengajuanModal(ukmId, namaUkm) {
    document.getElementById('namaUKM').textContent = namaUkm;
    document.getElementById('formPengajuan').action = "{{ url('/mahasiswa/ukm') }}/" + ukmId + "/ajukan";
    document.getElementById('pengajuanModal').classList.remove('hidden');
}
</script>
@endpush
@endsection
