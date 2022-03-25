<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoRequest extends FormRequest
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
            'date' => 'required|String',
            'no_spmp' => 'required|String',
            'approved_by' => 'required|String',
            'job_terms' => 'required|String',
            'ketentuan_pekerjaan' => 'required|String',
            'ketentuan_pembayaran' => 'required|String',
            'ppn' => 'nullable|Integer',
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
