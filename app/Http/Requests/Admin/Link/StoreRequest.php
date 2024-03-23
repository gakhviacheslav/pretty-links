<?php

namespace App\Http\Requests\Admin\Link;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'original_link'=>'required|url',
            'max_views'=>'required|integer',
            'expired_at'=>'required|date_format:H:i:s',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'This field is required',
            'name.string'=>'It will be text',
            'original_link.required'=>'This field is required',
            'original_link.url'=>'This field field must be a valid URL',
            'max_views.required'=>'This field is required',
            'max_views.integer'=>'It will be integer',
            'expired_at.required'=>'This field is required',

        ];
    }
}
