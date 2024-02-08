<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class ArticleSaveRequest extends FormRequest
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
    public function rules()
    {
        return RuleFactory::make([
            'category_id' => 'required|numeric|exists:categories,id',
            '%title%' => 'nullable|min:2|max:255',
            '%subtitle%' => 'nullable|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'image' => 'nullable|image|mimes:jpg,png',
            'publish_date' => 'nullable|date',
            'is_public' => 'boolean',
        ]);
    }

    /**
     * Prepare inputs for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_public' => $this->toBoolean($this->is_public),
        ]);
    }

    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return boolean
     */
    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    public function attributes()
    {
        return RuleFactory::make([
            'category_id' => __('messages.category'),
            '%title%' => __('messages.title'),
            '%subtitle%' => __('messages.subtitle'),
            'slug' => __('messages.slug'),
            'image' => __('messages.image'),
            'publish_date' => __('messages.publish_date'),
            'is_public' => __('messages.is_public'),
        ]);
    }
}
