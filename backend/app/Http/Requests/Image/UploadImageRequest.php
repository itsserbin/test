<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    final public function rules(): array
    {
        return [
            'image' => [
                'required',
                'mimes:jpeg,png,jpg,webp',
                'max:5016'
            ],
            'filename' => [
                'string',
                'nullable',
                'max:255'
            ],
            'path' => [
                'string',
                'nullable',
                'max:255'
            ],
            'alt' => [
                'string',
                'nullable',
                'max:255'
            ],
            'title' => [
                'string',
                'nullable',
                'max:255'
            ]
        ];
    }
}
