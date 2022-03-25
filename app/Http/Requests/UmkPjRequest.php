<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmkPjRequest extends FormRequest
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
            'no_memo_umk' => 'required|String',
            'name' => 'required|String',
            'no_pekerja' => 'required|String',
            'jabatan' => 'required|String',
            'fungsi' => 'required|String',
            'gl_account' => 'required|String',
            'cost_center' => 'required|String',
            'total' => 'required|String',
            'invoice_file' => 'nullable',
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
