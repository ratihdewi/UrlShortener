<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            // 'email' => 'required|email',
            // 'category_id' => 'required|array',
            // 'no_rek' => 'required|String',
            // 'address' => 'required|String',
            // 'bank_name' => 'required|String',
            // 'no_telp' => 'required|String',
            // 'no_tax' => 'required|String',
            // 'afiliasi' => 'nullable|Boolean',
            // 'pic_name' => 'required|String'
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
