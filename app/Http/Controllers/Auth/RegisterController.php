<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Tambahkan custom messages untuk validasi
        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah terdaftar.',
            // ... tambahkan pesan lainnya ...
        ];

        // Validasi input
        $request->validate([
            // Validasi data akun
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            // Validasi data mahasiswa
            'nim' => 'required|string|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'angkatan' => 'required|integer|min:2000',
            'semester' => 'required|integer|min:1|max:14',
            'program_studi' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
        ], $messages);

        try {
            // Mulai transaksi database
            DB::beginTransaction();

            // Buat user baru
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa', // Set role sebagai mahasiswa
            ]);

            // Buat data mahasiswa
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'angkatan' => $request->angkatan,
                'semester' => $request->semester,
                'program_studi' => $request->program_studi,
                'fakultas' => $request->fakultas,
            ]);

            // Commit transaksi
            DB::commit();

            // Login user setelah registrasi
            auth()->login($user);

            // Redirect ke halaman yang sesuai
            return redirect('/')->with('success', 'Registrasi berhasil!');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.']);
        }
    }
} 