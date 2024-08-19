<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBatteryRequest extends FormRequest
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
            'battery' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'battery.required' => 'Battery is required',
            'battery.integer' => 'Battery must be an integer',
            'battery.min' => 'Battery must be at least 0',
            'battery.max' => 'Battery must be at most 100',
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
