<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranUKM extends Model
{
    protected $table = 'pendaftaran_ukm';

    protected $fillable = [
        'mahasiswa_id',
        'ukm_id',
        'alasan_pengajuan',
        'tanggal_wawancara',
        'status'
    ];

    protected $casts = [
        'tanggal_wawancara' => 'datetime'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function ukm()
    {
        return $this->belongsTo(UKM::class);
    }
}