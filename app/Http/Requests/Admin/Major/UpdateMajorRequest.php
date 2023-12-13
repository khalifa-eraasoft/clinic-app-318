<?php

namespace App\Http\Requests\Admin\Major;

use App\Models\Major;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
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
            'title' => ['required', 'string', 'unique:majors,title,' . $this->major->id, 'max:50'],
            'status' => ['required', Rule::in($status)],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'mimetypes:image/jpeg,image/png', 'max:700']
        ];
    }
}
