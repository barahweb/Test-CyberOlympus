<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertCustomerValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => ['required', 'numeric'],
        ];
    }
    public function messages()
    {
        return[
            'title.required' => "masukan title",
            'release.required' => "masukan tahun release",
        ];
    }
}
