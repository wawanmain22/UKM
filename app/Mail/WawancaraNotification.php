<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PendaftaranUKM;

class WawancaraNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;

    public function __construct(PendaftaranUKM $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    public function build()
    {
        return $this->subject('Jadwal Wawancara UKM')
                    ->view('emails.wawancara');
    }
} 