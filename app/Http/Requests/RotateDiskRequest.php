<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RotateDiskRequest extends FormRequest
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
            'angle' => 'required|numeric',
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
            'angle.required' => 'Angle is required',
            'angle.numeric' => 'Angle must be a number',
            'angle.min' => 'Angle must be between 0 and 360',
            'angle.max' => 'Angle must be between 0 and 360',
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
