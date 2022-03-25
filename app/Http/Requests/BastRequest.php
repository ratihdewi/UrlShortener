<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BastRequest extends FormRequest
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
            'no_surat' => 'required|String',
            'user_id' => 'required|Integer',
            'nama_pihak_kedua' => 'required|String',
            'jabatan_pihak_kedua' => 'required|String',
            'bast_file' => 'nullable',
        ];
    }

    /**
    * Custom message for validation
    *
    * @return array
    */
    public function messages()
    {
        return [
            'required' => ':attribute harus diisi.',
        ];
    }
}
