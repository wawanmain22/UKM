<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class UserMahasiswaSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Buat data Ketua UKM (hanya 1 data)
        $ketuaUKM = User::create([
            'email'    => 'ketua@ukm.com',
            'password' => Hash::make('password'),
            'role'     => 'ketua_ukm',
        ]);

        // Jika diperlukan, kamu bisa menambahkan data khusus untuk ketua,
        // misalnya menyimpan data ke tabel lain (misalnya dosen atau staff) jika ada.

        // Buat 5 data Mahasiswa
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'email'    => "mahasiswa{$i}@univ.com",
                'password' => Hash::make('password'),
                'role'     => 'mahasiswa',
            ]);

            // Buat data mahasiswa terkait dengan user yang baru dibuat
            Mahasiswa::create([
                'nim'            => 'NIM' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama'           => 'Mahasiswa ' . $i,
                'kelas'          => 'Kelas ' . $i,
                'angkatan'       => 2020,
                'semester'       => 1,
                'program_studi'  => 'Teknik Informatika',
                'fakultas'       => 'Teknik',
                'user_id'        => $user->id,
            ]);
        }
    }
}
