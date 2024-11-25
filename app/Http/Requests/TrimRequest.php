<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrimRequest extends FormRequest
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
                'model_id' => 'nullable|exists:App\Models\Model,id',
            ];
        }
        return [
            'name' => 'required|min:3|max:255',
            'model_id' => 'required|exists:App\Models\Model,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A megnevezés kötelező mező!',
            'name.min' => 'Legalább 3 karakter legyen!',
            'name.max' => 'Legfeljebb 255 karakter legyen!',
            'model_id.required' => 'A model kötelező mező!',
        ];
    }
}
