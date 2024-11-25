<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicRequest extends FormRequest
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
        if ($this->method() === 'PATCH') {
            return ['name' => 'nullable|min:3|max:255'];
        }
        return [
            'name' => 'required|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Kötelező mező!',
            'name.min' => 'Legalább 3 karakter legyen!',
            'name.max' => 'Legfeljebb 255 karakter legyen!',
        ];
    }
}
