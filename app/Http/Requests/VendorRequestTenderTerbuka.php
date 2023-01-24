<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequestTenderTerbuka extends FormRequest
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
            'name' => 'required|String',
            'email' => 'required|email',
            'no_rek' => 'required|String',
            'address' => 'required|String',
            'bank_name' => 'required|String',
            'no_telp' => 'required|String',
            'no_tax' => 'required|String',
            'afiliasi' => 'nullable|Boolean',
            'file_penawaran' => 'nullable',
            'data_penawaran' => 'nullable',
            'no_penawaran' => 'nullable|String',
            'pic_name' => 'required|String',
            'captcha' => 'required|captcha',
            'category_id' => 'required|array'
        ];
    }

    /**
    * Custom message for validation
    *
    * @return array
    */
    public function messages()
    {
        $msg = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'no_rek.required' => 'Nomor rekening wajib diisi',
            'address.required' => 'Alamat wajib diisi',
            'bank_name.required' => 'Nama bank wajib diisi',
            'no_telp.required' => 'Nomor telepon wajib diisi',
            'no_tax.required' => 'NPWP wajib diisi',
            'pic_name.required' => 'PIC wajib diisi',
            'captcha.required' => 'Captcha wajib diisi',
            'category_id.required' => 'Bidang usaha wajib diisi'
        ];

        return $msg;
    }
}
