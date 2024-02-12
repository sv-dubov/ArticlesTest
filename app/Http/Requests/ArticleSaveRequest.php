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
            'image' => 'required|image|mimes:jpg,png',
            'publish_date' => 'nullable|date',
            'is_public' => 'boolean',
            '%seo_title%' => 'nullable|min:2|max:255',
            '%seo_description%' => 'nullable|min:2|max:255',
            'video.*.link' => 'nullable|max:255',
            'video.*.sequence_number' => 'nullable|integer|min:1',
            'text.*.%content%' => 'nullable',
            'text.*.sequence_number' => 'nullable|integer|min:1',
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
            '%seo_title%' => __('messages.seo_title'),
            '%seo_description%' => __('messages.seo_description'),
            'video' => __('messages.video'),
            'video.*.link' => __('messages.link'),
            'video.*.sequence_number' => __('messages.sequence_number'),
            'text' => __('messages.text'),
            'text.*.%content%' => __('messages.content'),
            'text.*.sequence_number' => __('messages.sequence_number'),
        ]);
    }
}
