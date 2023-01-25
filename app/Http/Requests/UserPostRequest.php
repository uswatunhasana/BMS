<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Validation\Rules\Password;
use App\Enums\UserType;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|max:255',
            'role' => 'required',
            'password' => ['required', 'string', 'confirmed', Password::min(8)
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
