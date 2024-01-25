<?php

namespace App\Http\Requests\Video;

use Illuminate\Support\Str;
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
            'name' => 'required|min:3|max:128',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:videos,slug|alpha_dash:ascii',
            'file' => 'required|file|mimetypes:video/mp4',
            'description' => 'nullable|min:10',
        ];
    }

    protected function prepareForValidation() :void
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }
}
