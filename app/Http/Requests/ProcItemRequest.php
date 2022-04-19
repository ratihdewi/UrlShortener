<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcItemRequest extends FormRequest
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
            'procurement_id' => 'required|Integer',
            'price_est' => 'required|String',
            'total_unit' => 'required|Integer',
            'specs' => 'required|String',
            'category_id' => 'required|Integer',
            'vendor_name' => 'nullable|array',
            'vendor_email' => 'nullable|array',
            'satuan' => 'required|String',
            'brosur_file' => 'nullable'
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
