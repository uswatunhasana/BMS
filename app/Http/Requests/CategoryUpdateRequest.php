<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:categories,name,NULL' . $this->route('category') .',id,deleted_at,NULL,',
            'user_id' => 'nullable',
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
