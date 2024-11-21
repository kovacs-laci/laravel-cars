<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
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
        if ($this->method() === 'PATCH') {
            return [
                'registration_plate' => 'nullable|min:6,registration_plate',
                'vin' => 'nullable|vin',
                'engine_id' => 'nullable|min:3',
                'production_year' => 'nullable|numeric|min:1900|max:' . date('Y'),
                'capacity' => 'nullable|numeric|min:1',
                'power' => 'nullable|numeric|min:1',
                'valid_until' => 'nullable|date',
                'notes' => 'nullable|max:65535',
            ];
        }
        return [
            'registration_plate' => 'required|min:6,registration_plate', Rule::unique('vehicles')->ignore($id),
            'vin' => 'required|vin', Rule::unique('vehicles')->ignore($id),
            'engine_id' => 'min:3',
            'production_year' => 'numeric|min:1900|max:' . date('Y'),
            'capacity' => 'numeric|min:1',
            'power' => 'numeric|min:1',
            'valid_until' => 'date',
            'notes' => 'max:65535',
        ];
    }
}
