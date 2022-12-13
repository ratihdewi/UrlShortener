<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BappMultipleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'procurement' => 'required',
            // 'tanggal_bapp' => 'required',
            // 'no_surat_bapp' => 'required',
            // 'lokasi' => 'required',
            // 'dari' => 'required',
            // 'kepada' => 'required',
            // 'po_date.*' => 'required',
            // 'po_spph_id.*' => 'required',
            // 'po_no_spmp.*' => 'required',
            // 'po_approved_by.*' => 'required',
            // 'po_ketentuan_pekerjaan.*' => 'required',
            // 'po_ketentuan_pembayaran.*' => 'required',
            // 'bast_no_surat.*' => 'required',
            // 'bast_user_id.*' => 'required',
            // 'bast_nama_pihak_kedua.*' => 'required',
            // 'bast_jabatan_pihak_kedua.*' => 'required',
            // 'pv_spph_id.*' => 'required',
            // 'pv_vendor_id.*' => 'required',
            // 'pv_score.*' => 'required',
            // 'pv_comment.*' => 'required',
            // 'sp3_keterangan' => 'required',
            // 'sp3_file' => 'required',
        ];
    }

    // public function messages()
    // {

        // $msg = [
        //     'tanggal_bapp.required' => 'Tanggal pada kolom BAPP wajib diisi',
        //     'no_surat_bapp.required' => 'Nomor Surat pada kolom BAPP wajib diisi',
        //     'lokasi.required' => 'Lokasi pada kolom BAPP wajib diisi',
        //     'dari.required' => "'Dari' pada kolom BAPP wajib diisi",
        //     'kepada.required' => "'Kepada' pada kolom BAPP wajib diisi",
        //     'sp3_keterangan.required' => "Keterangan pada SP3 wajib diisi",
        //     'sp3_file.required' => "Dokumen SP3 wajib diisi",
        // ];

        // foreach($this->get('po_spph_id') as $key=>$val) {
        //     $i = $key + 1;

        //     $msg["po_date.$key.required"] = "Tanggal pada kolom PO urutan ke-$i wajib diisi";
        //     $msg["po_no_spmp.$key.required"] = "Nomor SPMP pada kolom PO urutan ke-$i wajib diisi";
        //     $msg["po_approved_by.$key.required"] = "'Disetujui oleh' pada kolom PO urutan ke-$i wajib diisi";
        //     $msg["po_ketentuan_pekerjaan.$key.required"] = "Ketentuan Pekerjaan pada kolom PO urutan ke-$i wajib diisi";
        //     $msg["po_ketentuan_pembayaran.$key.required"] = "Ketentuan Pembayaran pada kolom PO urutan ke-$i wajib diisi";
        //     $msg["bast_no_surat.$key.required"] = "Nomor surat pada kolom BAST urutan ke-$i wajib diisi";
        //     $msg["bast_user_id.$key.required"] = "Pihak pertama pada kolom BAST urutan ke-$i wajib diisi";
        //     $msg["bast_nama_pihak_kedua.$key.required"] = "Nama pihak kedua pada kolom BAST urutan ke-$i wajib diisi";
        //     $msg["bast_jabatan_pihak_kedua.$key.required"] = "Jabatan pihak kedua pada kolom BAST urutan ke-$i wajib diisi";
        //     $msg["pv_spph_id.$key.required"] = "SPPH pada penilaian vendor urutak ke-$i wajib diisi";
        //     $msg["pv_vendor_id.$key.required"] = "Vendor pada penilaian vendor urutak ke-$i wajib diisi";
        //     $msg["pv_score.$key.required"] = "Skor pada penilaian vendor urutak ke-$i wajib diisi";
        //     $msg["pv_comment.$key.required"] = "Komentar pada penilaian vendor urutak ke-$i wajib diisi";
        // }

        // return $msg;
    // }
}
