<?php

namespace App\Http\Requests\Category;

use App\Models\CategoryAttribute;
use Illuminate\Foundation\Http\FormRequest;

class ItemCategoryRequest extends FormRequest
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
        $rules = [
            'attributes' => [
                'array',
                'required'
            ],
            'attributes.title' => [
                'required',
                'string',
                'max:255'
            ],
            'attributes.description' => [
                'nullable',
                'string',
            ],
            'attributes.content' => [
                'nullable',
                'string',
            ],
            'meta' => [
                'array',
                'nullable'
            ],
            'meta.title' => [
                'nullable',
                'string',
                'max:255'
            ],
            'meta.description' => [
                'nullable',
                'string',
            ],
            'meta.keywords' => [
                'nullable',
                'string',
            ],
            'meta.canonical' => [
                'nullable',
                'string',
            ],
            'meta.noindex' => [
                'nullable',
                'boolean',
            ],
            'meta.og_title' => [
                'nullable',
                'string',
                'max:255'
            ],
            'meta.og_description' => [
                'nullable',
                'string',
            ],
            'meta.og_image' => [
                'nullable',
                'string',
            ],
            'meta.og_type' => [
                'nullable',
                'string',
            ],

            'meta.og_site_name' => [
                'nullable',
                'string',
            ],
        ];

        switch ($this->method()) {
            case 'POST':
                $rules['attributes.slug'] = [
                    'required',
                    'string',
                    'max:255',
                    'unique:category_attributes,slug'
                ];
                break;
            case 'PUT':
                $attrId = CategoryAttribute::select(['category_id', 'id'])
                    ->where('category_id', $this->route('id'))
                    ->first();

                $rules['attributes.slug'] = [
                    'required',
                    'string',
                    'max:255',
                    'unique:category_attributes,slug,' . $attrId->id
                ];
                break;
        }

        return $rules;
    }
}
