<?php

namespace App\Http\Requests\Admin\Album;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'cover' => 'image|mimes:jpg,png,gif,svg:max:2048',
            'content' => 'nullable',
            'is_published' => 'nullable',
            'genres' => 'nullable',
            'artists' => 'nullable',
            'tracks' => 'nullable',
            'slug' => 'nullable'
        ];
    }
}
