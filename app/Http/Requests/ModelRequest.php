<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
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
            return [
                'name' => 'nullable|min:3|max:255',
                'maker_id' => 'nullable',
            ];
        }
        return [
            'name' => 'required|min:3|max:255',
            'maker_id' => 'required|exists:makers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Model neve kötelező mező!',
            'name.min' => 'Model neve legalább 3 karakter legyen!',
            'name.max' => 'Model neve legfeljebb 255 karakter legyen!',
            'maker_id.required' => 'Gyártó azonosító kötelező mező!',
        ];
    }
}
