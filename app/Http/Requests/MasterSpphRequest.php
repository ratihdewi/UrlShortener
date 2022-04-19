<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterSpphRequest extends FormRequest
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
            'syarat' => 'required|String',
            'kriteria_penilaian' => 'required|String',
            'ttd' => 'nullable'
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
