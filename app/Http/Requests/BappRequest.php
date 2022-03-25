<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BappRequest extends FormRequest
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
            'no_surat' => 'required|String',
            'dari' => 'required|Integer',
            'kepada' => 'required|Integer',
            'location' => 'required|String',
            'reason' => 'nullable|String',
            'spph_date' => 'required|String',
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
