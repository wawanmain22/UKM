<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UKM extends Model
{
    use HasFactory;

    // Nama tabel: 'ukm'
    protected $table = 'ukm';

    /**
     * Atribut yang bisa diisi secara massal.
     */
    protected $fillable = [
        'nama_ukm',
        'deskripsi_ukm',
        'link_sosial_media',
    ];

    /**
     * Relasi satu-ke-banyak ke pendaftaran UKM.
     */
    public function pendaftaranUKM()
    {
        return $this->hasMany(PendaftaranUKM::class, 'ukm_id');
    }
}
