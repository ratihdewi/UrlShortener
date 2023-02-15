<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ProcurementSpph;

class PenawaranDoneMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $spph_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($spph_id)
    {
        $this->spph_id = $spph_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $spph = ProcurementSpph::find($this->spph_id);
        $perihal = $spph->procurement->name;
        $pengirim_email = "pengadaan@universitaspertamina.ac.id";
        $alter = "Pengadaan Universitas Pertamina";

        return $this->from($pengirim_email, $alter)
            ->view('module.procurement.detail.penawaran.penawaran_done_email')
            ->subject('Proses Penawaran Sudah Ditutup')
            ->with(
            [
                'pengirim' => 'Pengadaan Universitas Pertamina',
                'penerima' => $spph->vendor->name,
                'perihal' => $perihal,
            ]);

        return $this->view('view.name');
    }
}
