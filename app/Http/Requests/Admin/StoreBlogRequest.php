<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'image' => [
                'required',
                'file',
                'image',
                'max:2000',
                'mimes:jpeg,jpg,png',
                'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200'
            ],
            'content' => ['required', 'max:2000']
        ];
    }
}
