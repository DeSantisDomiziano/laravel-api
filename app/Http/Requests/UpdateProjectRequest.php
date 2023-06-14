<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => ['required', 'min:2', 'max:70'],
            "img_path" => ['required', 'image', 'max:1000'],
            "overview" => ['nullable', 'min:2'],
            "link_code" => ['nullable', 'min:2'],
            "link_website" => ['nullable', 'min:2'],
            "type_id" => ['exists:types,id'],
            "technologies" => ['exists:technologies,id']
        ];
    }
}
