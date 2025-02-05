<?php

namespace App\Http\Controllers;

use App\Models\UKM;
use App\Models\PendaftaranUKM;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar UKM untuk mahasiswa
     */
    public function daftarUKM()
    {
        $ukms = UKM::with(['pendaftaranUKM' => function($query) {
            $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
        }])->get();

        return view('mahasiswa.daftarukm', compact('ukms'));
    }

    /**
     * Menampilkan daftar pengajuan UKM mahasiswa
     */
    public function pengajuan()
    {
        $pengajuanList = PendaftaranUKM::with('ukm')
            ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
            ->latest()
            ->get();

        return view('mahasiswa.pengajuan', compact('pengajuanList'));
    }

    /**
     * Mengajukan pendaftaran UKM
     */
    public function ajukanUKM(Request $request, UKM $ukm)
    {
        try {
            // Validasi input
            $request->validate([
                'alasan_pengajuan' => 'required|string',
            ], [
                'alasan_pengajuan.required' => 'Alasan pengajuan wajib diisi',
            ]);

            // Cek apakah sudah pernah mendaftar
            $existingPendaftaran = PendaftaranUKM::where('mahasiswa_id', auth()->user()->mahasiswa->id)
                ->where('ukm_id', $ukm->id)
                ->first();

            if ($existingPendaftaran) {
                return back()->with('error', 'Anda sudah pernah mendaftar di UKM ini.');
            }

            // Buat pendaftaran baru
            PendaftaranUKM::create([
                'mahasiswa_id' => auth()->user()->mahasiswa->id,
                'ukm_id' => $ukm->id,
                'alasan_pengajuan' => $request->alasan_pengajuan,
                'status' => 'pending'
            ]);

            return redirect()->route('mahasiswa.daftarukm')->with('success', 'Pengajuan pendaftaran UKM berhasil dikirim.');

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saat mengajukan UKM: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengirim pengajuan. Silakan coba lagi.')
                        ->withInput();
        }
    }

    /**
     * Batalkan pengajuan UKM yang masih pending
     */
    public function batalkanPengajuan(PendaftaranUKM $pendaftaran)
    {
        // Cek apakah pengajuan milik mahasiswa yang login
        if ($pendaftaran->mahasiswa_id !== auth()->user()->mahasiswa->id) {
            return back()->with('error', 'Anda tidak memiliki akses untuk membatalkan pengajuan ini.');
        }

        // Cek apakah status masih pending
        if ($pendaftaran->status !== 'pending') {
            return back()->with('error', 'Pengajuan yang sudah diproses tidak dapat dibatalkan.');
        }

        $pendaftaran->delete();
        return back()->with('success', 'Pengajuan berhasil dibatalkan.');
    }
} 