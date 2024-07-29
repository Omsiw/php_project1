<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:3|max:20|string',
            'cost' => 'integer',
            'info' => 'string',
            'o_s_ids' => 'array',
            'tag_ids' => 'array',
            'author_ids' => 'array',
            'publisher_ids' => 'array|nullable'
        ];
    }
}
