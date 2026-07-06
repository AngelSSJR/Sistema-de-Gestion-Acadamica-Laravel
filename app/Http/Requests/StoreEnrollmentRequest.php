<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'academic_period' => ['required', 'string', 'max:20'],
            'enrollment_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'completed', 'withdrawn'])],
        ];
    }
}
