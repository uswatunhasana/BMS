<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Validator; 

class NewsUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:news,title,NULL' . $this->route('news') .',id,deleted_at,NULL,',
            'content' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            'slug' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Title is required',
            'content.required'    => 'Content is required',
            'content.required'    => 'Content is required',
            'title.unique'      => 'The title has already been taken. Try another title.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return Alert::error(' Error Tambah Data ', ' Silahkan Periksa Kembali');
    }

}
