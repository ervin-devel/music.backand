<?php

namespace App\Http\Requests\Admin\Track;

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
            'artist' => 'required|string',
            'name' => 'required|string',
            'id3v1_year' => 'nullable',
            'id3v1_album' => 'nullable',
            'lyurics' => 'nullable',
            'artists' => 'nullable'
        ];
    }
}
