<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatagoryRequest extends FormRequest
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
            'catagory_name'=>'required|unique:catagories',
            'catagory_image'=>'required|file|image|max:2024',
        ];
    }

    public function messages()
    {
        return[

                'catagory_name.required'=>'why catagory_name is empty',
                'catagory_name.unique'=>'already added',
                'catagory_image.required'=>'Upload Catagory Image',


        ];
    }
}
