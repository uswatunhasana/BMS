<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class CategoryPostRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return false;
    // }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,deleted_at,NULL',
            'user_id' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Category name is required',
            'name.unique'      => 'The category has already been taken. Try another category.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Alert::error(' Error Tambah Data ', ' Silahkan Periksa Kembali');
    }
}
