<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ProcurementSpph;

class SpphMail extends Mailable
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
        $pengirim_email = "pengadaan@universitaspertamina.ac.id";
        $alter = "Pengadaan Universitas Pertamina";

        return $this->from($pengirim_email, $alter)
            ->view('module.procurement.detail.mail')
            ->subject('Pengajuan Spph')
            ->attach(public_path('spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.xlsx'))
            ->attach(public_path('spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf'))
            ->with(
            [
                'url' => 'http://localhost/procurement/public/spph-tor/download/'.$this->spph_id,
                'pengirim' => 'Pengadaan Universitas Pertamina',
                'penerima' => $spph->vendor->name,
            ]);

        return $this->view('view.name');
    }
}
