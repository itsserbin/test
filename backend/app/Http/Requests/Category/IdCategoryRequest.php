<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class IdCategoryRequest extends FormRequest
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
            'id' => [
                'required',
                'integer',
                'exists:categories,id'
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('id')]);
    }
}
