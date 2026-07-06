<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'], // Course names can have numbers (e.g. "10° Grado A")
            'code' => ['required', 'string', 'max:20', Rule::unique('courses', 'code')],
            'level' => ['nullable', 'string', 'max:50'],
            'section' => ['nullable', 'string', 'max:10'],
            'academic_year' => ['nullable', 'string', 'max:20'],
            'is_active' => ['boolean'],
        ];
    }
}
