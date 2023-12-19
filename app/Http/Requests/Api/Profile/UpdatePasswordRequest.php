<?php

namespace App\Http\Requests\Api\Profile;

use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    use ApiResponseTrait;

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
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth('api')->user()->password)) {
                    $fail('Wrong Old Password');
                }
            }],
            'new_password' => ['required', 'min:8', 'max:20', 'confirmed', function ($attribute, $value, $fail) {
                if (Hash::check($value, auth('api')->user()->password)) {
                    $fail('New Password Mustnot Be Same Old Password');
                }
            }]
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
