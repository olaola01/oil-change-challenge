<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OilChangeRequest extends FormRequest
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
            'current_odometer' => 'required|integer|gte:previous_odometer',
            'previous_date' => 'required|date|before:today',
            'previous_odometer' => 'required|integer',
        ];
    }
}
