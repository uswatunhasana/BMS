<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore([auth()->id(), 'deleted_at'])],
        ];
    }

    public function messages()
    {
        return [
            'email.unique'      => 'The email has already been taken. Try another email.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Alert::error(' Error Tambah Data ', ' Silahkan Periksa Kembali');
    }
}
