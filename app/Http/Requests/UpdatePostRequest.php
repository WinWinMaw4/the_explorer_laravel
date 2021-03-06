<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('update',request()->post);
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
            "title" => "required|unique:posts,title,".$this->route('post')->id."|min:5",
//            "excerpt"=>"required|unique:posts,excerpt,".$this->route('post')->id."|min:1|max:70",
            "description" => "required|min:15",
            "cover" => "nullable|file|mimes:jpeg,png|max:5000"
        ];
    }
}
