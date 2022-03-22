<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Procurement;

class BappLoseMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $procurement_id;
    protected $vendor_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendor_name, $procurement_id)
    {
        $this->procurement_id = $procurement_id;
        $this->vendor_name = $vendor_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $procurement = Procurement::find($this->procurement_id);
        $perihal = $procurement->name;
        $pengirim_email = "pengadaan-dev@universitaspertamina.ac.id";
        $alter = "Pengadaan Universitas Pertamina";

        return $this->from($pengirim_email, $alter)
            ->view('module.procurement.detail.bapp.vendor_lose_mail')
            ->subject('Penawaran Kalah')
            ->with(
            [
                'pengirim' => 'Pengadaan Universitas Pertamina',
                'penerima' => $this->vendor_name,
                'perihal' => $perihal,
            ]);

        return $this->view('view.name');
    }
}
