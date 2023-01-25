<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 

class PasswordRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'old_password' => ['required', 'min:6', new CurrentPasswordCheckRule],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => __('current password'),
        ];
    }
    
    public function messages()
    {
        return [
            'old_password.required'    => 'Old password is required',
            'password.required'    => 'Password user is required',
            'password_confirmation.required'    => 'Confirmation password is required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Alert::error('Error Ubah Password', ' Silahkan Periksa Kembali Password Lama Anda');
    }
}
