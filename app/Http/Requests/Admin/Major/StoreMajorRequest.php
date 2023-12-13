<?php

namespace App\Http\Requests\Admin\Major;

use App\Models\Major;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMajorRequest extends FormRequest
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
        $status = Major::$status;
        return [
            'title' => ['required', 'string', 'unique:majors,title', 'max:50', function ($attribute, $value, $fail) {
                if ($value == 'mohammed') {
                    $fail('not allowed');
                }
            }],
            'status' => ['required', Rule::in($status)],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'mimetypes:image/jpeg,image/png', 'max:700']
        ];
    }

    // public function failedValidation($validator)
    // {
    //     return toastr()->addError($validator);
    // }
}
