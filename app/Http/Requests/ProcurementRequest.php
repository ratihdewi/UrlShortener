<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementRequest extends FormRequest
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
            'mechanism_id' => 'nullable|String',
            'status' => 'required|String',
            'tor_file' => 'nullable',
            'item_file' => 'nullable',
            'no_memo' => 'required|String',
            'vendor_id' => 'nullable|Integer',
            'vendor_id_afiliasi' => 'nullable|Integer',
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
