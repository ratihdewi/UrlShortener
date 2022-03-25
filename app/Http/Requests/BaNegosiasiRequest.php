<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaNegosiasiRequest extends FormRequest
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
            'time' => 'required|String',
            'location' => 'required|String',
            'meeting_result' => 'required|String',
            'photo_doc' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'negosiasi' => 'required|String',
            'penawaran_id' => 'required|array',
            'peserta_id' => 'required|array',
            'peserta_eksternal' => 'required|String',
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
