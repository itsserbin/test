<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListCategoryRequest extends FormRequest
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
            'with' => [
                'nullable',
                'array',
            ],
            'with.*' => [
                'string',
                'max:255'
            ],
            'select' => [
                'nullable',
                'array',
            ],
            'select.*' => [
                'string',
                'max:255'
            ],
            'orderBy' => [
                'string',
                'nullable',
                'max:255'
            ],
            'orderType' => [
                'string',
                'nullable',
                'max:255'
            ]
        ];
    }
}
