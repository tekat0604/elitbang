<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiRevisi extends Mailable
{
    use Queueable, SerializesModels;

    public $jenis;
    public $instansi;
    public $catatan;

    /**
     * Create a new message instance.
     */
    public function __construct($jenis, $instansi, $catatan)
    {
        $this->jenis = $jenis;
        $this->instansi = $instansi;
        $this->catatan = $catatan;
    }

    public function build()
    {
        return $this->subject("Pemberitahuan Revisi {$this->jenis} - e-Litbang")
            ->view('emails.notifikasi-revisi');
    }
}
