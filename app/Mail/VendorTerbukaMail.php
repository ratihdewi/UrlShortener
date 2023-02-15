<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MasterMail;
use App\Models\VendorTenderTerbuka;

class VendorTerbukaMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $statusVendor;
    protected VendorTenderTerbuka $vendorTT;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($statusVendor, $vendorTT)
    {
        $this->statusVendor = $statusVendor;
        $this->vendorTT = $vendorTT;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pengirim_email = "pengadaan@universitaspertamina.ac.id";
        $alter = "Pengadaan Universitas Pertamina";
        $dataMail = MasterMail::find(1);

        return $this->from($pengirim_email, $alter)
            ->view('module.master.mail.send_mail_vendor_terbuka')
            ->subject('Pengumuman Pengajuan Vendor')
            ->with([
                'pengirim' => 'Pengadaan Universitas Pertamina',
                'penerima' => $this->vendorTT->email,
                'status' => $this->statusVendor,
                'isi_pesan' => $dataMail,
                'vendor' => $this->vendorTT
            ]);

        return $this->view('view.name');
    }
}
