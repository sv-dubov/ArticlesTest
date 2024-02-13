<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GallerySaveRequest extends FormRequest
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
            'article_id' => 'required|numeric|exists:articles,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,png',
            'sequence_number' => 'required|integer|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'article_id' => __('messages.article'),
            'images' => __('messages.images'),
            'sequence_number' => __('messages.sequence_number'),
        ];
    }
}
