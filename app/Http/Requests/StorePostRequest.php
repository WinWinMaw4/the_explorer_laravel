<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            //unique:table,column
            "title" => "required|unique:posts,title|min:5",
//            "excerpt"=>"required|unique:posts,excerpt|min:1|max:70",
            "description" => "required|min:15",
            "cover" => "required|file|mimes:jpeg,png|max:5000"
        ];
    }
}
