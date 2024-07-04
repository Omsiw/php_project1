<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModRequest extends FormRequest
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
            'game_id' => 'integer', 
            'author_id' => 'integer', 
            'name' => 'min:3|max:20|string', 
            'info' => 'string', 
            'date_add' => 'date'
        ];
    }
}
