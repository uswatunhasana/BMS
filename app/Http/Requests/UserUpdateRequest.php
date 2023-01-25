<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 
class UserUpdateRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return false;
    // }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL' . $this->route('user'),
            'password' => ['nullable','string', 'confirmed', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Name for user is required',
            'role.required'    => 'Role user is required',
            'email.required'    => 'Email user is required',
            'email.unique'      => 'The email has already been taken. Try another email.',
            'password.required'    => 'Password user is required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Alert::error(' Error Tambah Data ', ' Silahkan Periksa Kembali');
    }
}
