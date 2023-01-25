<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Validation\Rule;

class NewsPostRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return false;
    // }


    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:news,title,NULL,id,deleted_at,NULL',
            'content' => 'required',
            'user_id' => 'nullable',
            'category_id' => 'required',
            'tags' => 'required',
            'slug' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Title is required',
            'content.required'    => 'Content is required',
            'thumbnail.required'    => 'Thumbnail is required',
            'title.unique'      => 'The title has already been taken. Try another title.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Alert::error(' Error Tambah Data ', ' Silahkan Periksa Kembali');
    }
}
