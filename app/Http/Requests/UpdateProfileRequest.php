<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
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
            'firstname' => ['string', 'max:255'],
            'lastname' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'password' => ['string', 'min:8'],
            'passcode' => ['string', 'max:4', 'min:4'],
            'country' => ['string']
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
            'firstname.string' => 'First name must be a string',
            'firstname.max' => 'First name must not be greater than 255 characters',
            'lastname.string' => 'Last name must be a string',
            'lastname.max' => 'Last name must not be greater than 255 characters',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not be greater than 255 characters',
            'email.unique' => 'Email is already taken',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 8 characters',
            'passcode.string' => 'Passcode must be a string',
            'passcode.max' => 'Passcode must be 4 characters',
            'passcode.min' => 'Passcode must be 4 characters'
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
