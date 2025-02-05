<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel: 'mahasiswa'
    protected $table = 'mahasiswas';

    /**
     * Atribut yang bisa diisi secara massal.
     */
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'angkatan',
        'semester',
        'program_studi', // menggantikan 'prodi'
        'fakultas',
        'user_id',       // foreign key yang merujuk ke tabel users
    ];

    /**
     * Relasi kebalikannya ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
