<?php

namespace App\Http\Controllers;

use App\Models\UKM;
use App\Models\PendaftaranUKM;
use Illuminate\Http\Request;
use App\Mail\WawancaraNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Mailjet\Client;
use Mailjet\Resources;

class UKMController extends Controller
{
    public function index()
    {
        $ukm = UKM::orderBy('created_at', 'desc')->get();
        return view('ketua-ukm.ukm', compact('ukm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ukm' => 'required|string|max:255',
            'deskripsi_ukm' => 'required|string',
            'link_sosial_media' => 'required|string|max:255',
        ]);

        UKM::create($request->all());
        return redirect()->route('ketua.ukm')->with('success', 'UKM berhasil ditambahkan!');
    }

    public function update(Request $request, UKM $ukm)
    {
        $request->validate([
            'nama_ukm' => 'required|string|max:255',
            'deskripsi_ukm' => 'required|string',
            'link_sosial_media' => 'required|string|max:255',
        ]);

        $ukm->update($request->all());
        return redirect()->route('ketua.ukm')->with('success', 'UKM berhasil diperbarui!');
    }

    public function destroy(UKM $ukm)
    {
        $ukm->delete();
        return redirect()->route('ketua.ukm')->with('success', 'UKM berhasil dihapus!');
    }

    public function daftarPengajuan()
    {
        $pengajuanList = PendaftaranUKM::with(['mahasiswa', 'ukm'])
            ->latest()
            ->get();

        return view('ketua-ukm.pengajuan', compact('pengajuanList'));
    }

    public function updateStatus(Request $request, PendaftaranUKM $pendaftaran)
    {
        $request->validate([
            'tanggal_wawancara' => 'required|date',
        ], [
            'tanggal_wawancara.required' => 'Tanggal wawancara wajib diisi',
            'tanggal_wawancara.date' => 'Format tanggal tidak valid',
        ]);

        $pendaftaran->update([
            'tanggal_wawancara' => $request->tanggal_wawancara,
        ]);

        // Kirim email
        try {
            Mail::to($pendaftaran->mahasiswa->user->email)
                ->send(new WawancaraNotification($pendaftaran));
            
            return back()->with('success', 'Jadwal wawancara berhasil diperbarui dan email notifikasi telah dikirim!');
        } catch (\Exception $e) {
            // Log error dengan detail
            Log::error('Error saat mengirim email wawancara: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Pendaftaran ID: ' . $pendaftaran->id);
            Log::error('Email tujuan: ' . $pendaftaran->mahasiswa->user->email);
            
            return back()->with('error', 'Jadwal wawancara berhasil diperbarui tetapi gagal mengirim email. Error: ' . $e->getMessage());
        }
    }

    public function dashboard()
    {
        // Ambil data pengajuan terbaru (5 data terakhir)
        $pengajuanTerbaru = PendaftaranUKM::with(['mahasiswa', 'ukm'])
            ->latest()
            ->take(5)
            ->get();

        // Hitung total pengajuan yang belum ada jadwal wawancara
        $totalPengajuanPending = PendaftaranUKM::whereNull('tanggal_wawancara')->count();

        // Hitung total pengajuan yang sudah ada jadwal wawancara
        $totalPengajuanTerjadwal = PendaftaranUKM::whereNotNull('tanggal_wawancara')->count();

        // Ambil aktivitas terbaru (gabungan dari pengajuan)
        $aktivitasTerbaru = PendaftaranUKM::with(['mahasiswa', 'ukm'])
            ->latest()
            ->take(3)
            ->get();

        return view('ketua-ukm.dashboard', compact(
            'pengajuanTerbaru',
            'totalPengajuanPending',
            'totalPengajuanTerjadwal',
            'aktivitasTerbaru'
        ));
    }

    public function listUKM()
    {
        $ukms = UKM::orderBy('nama_ukm', 'asc')->get();
        return view('ukm.index', compact('ukms'));
    }

    public function sendEmailWithMailjet($to, $subject, $content)
    {
        try {
            $mj = app('mailjet');
            
            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => env('MAIL_FROM_ADDRESS'),
                            'Name' => env('MAIL_FROM_NAME')
                        ],
                        'To' => [
                            [
                                'Email' => $to,
                                'Name' => $to
                            ]
                        ],
                        'Subject' => $subject,
                        'HTMLPart' => $content
                    ]
                ]
            ];

            $response = $mj->post(Resources::$Email, ['body' => $body]);
            return $response->success();
        } catch (\Exception $e) {
            Log::error('Mailjet error: ' . $e->getMessage());
            return false;
        }
    }

    public function resendEmail(PendaftaranUKM $pendaftaran)
    {
        try {
            $content = view('emails.wawancara', ['pendaftaran' => $pendaftaran])->render();
            
            $success = $this->sendEmailWithMailjet(
                $pendaftaran->mahasiswa->user->email,
                'Jadwal Wawancara UKM',
                $content
            );
            
            if ($success) {
                return response()->json(['success' => true]);
            } else {
                throw new \Exception('Failed to send email through Mailjet');
            }
        } catch (\Exception $e) {
            Log::error('Error saat mengirim ulang email wawancara: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Pendaftaran ID: ' . $pendaftaran->id);
            Log::error('Email tujuan: ' . $pendaftaran->mahasiswa->user->email);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ]);
        }
    }
} 