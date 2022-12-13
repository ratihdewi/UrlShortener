<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpphMultipleRequest extends FormRequest
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
            // 'eval_tender_pdf' => 'required',
            // 'no_spph.*' => 'required',
            // 'name_vendor.*' => 'required',
            // 'spph_pdf.*' => 'required',
            // 'penawaran_pdf.*' => 'required',
            // 'harga_satuan.*' => 'required',
            // 'keterangan.*' => 'required',
            // 'evaluasi.*' => 'required',
            // 'nilai.*' => 'required',
            // 'date.*' => 'required',
            // 'time.*' => 'required',
            // 'location.*' => 'required',
            // 'peserta_eksternal.*' => 'required',
            // 'peserta_id.*' => 'required',
            // 'meeting_result.*' => 'required',
            // 'negosiasi.*' => 'required',
            // 'photo_doc.*' => 'required',
        ];
    }

    // public function messages ()
    // {

    //     $msg = [
    //         'procurement.required' => 'Procurement wajib dipilih',
    //         'eval_tender_pdf.required' => 'Dokumen evaluasi tender wajib diisi',
    //     ];

    //     foreach($this->get('no_spph') as $key=>$value) {
    //         $i = $key + 1;

    //         $msg["no_spph.$key.required"] = "Nomor SPPH pada bagian SPPH ke-$i wajib diisi";
    //         $msg["name_vendor.$key.required"] = "Nama Vendor pada bagian SPPH ke-$i wajib diisi";
    //         $msg["spph_pdf.$key.required"] = "Dokumen SPPH pada bagian SPPH ke-$i wajib diisi";
    //         $msg["penawaran_pdf.$key.required"] = "Dokumen penawaran pada bagian SPPH ke-$i wajib diisi";
    //         $msg["date.$key.required"] = "Tanggal pada bagian BA Negosiasi ke-$i wajib diisi";
    //         $msg["time.$key.required"] = "Waktu pada bagian BA Negosiasi ke-$i wajib diisi";
    //         $msg["peserta_eksternal.$key.required"] = "Peserta Eksternal pada bagian BA Negosiasi ke-$i wajib diisi";
    //         $msg["peserta_id.$key.required"] = "Peserta Internal pada bagian BA Negosiasi ke-$i wajib diisi";
    //         $msg["meeting_result.$key.required"] = "Hasil rapat pada bagian BA Negosiasi ke-$i wajib diisi";
    //         $msg["negosiasi.$key.required"] = "Harga negosiasi pada bagian BA Negosiasi ke-$i wajib diisi";
    //         $msg["photo_doc.$key.required"] = "Dokumentasi meeting pada bagian BA Negosiasi ke-$i wajib diisi";
    //     }

    //     foreach(explode(",", $this->get('arrNego')) as $key=>$value) {
    //         $i = $key + 1;
    //         $msg["harga_satuan.$key.required"] = "Harga satuan pada bagian Penawaran di baris ke-$i wajib diisi";
    //         $msg["keterangan.$key.required"] = "Keterangan pada bagian Penawaran di baris ke-$i wajib diisi";
    //         $msg["evaluasi.$key.required"] = "Evaluasi pada bagian Penawaran di baris ke-$i wajib diisi";
    //         $msg["nilai.$key.required"] = "Nilai pada bagian Penawaran di baris ke-$i wajib diisi";
    //     }

    //     return $msg;
    // }
}
