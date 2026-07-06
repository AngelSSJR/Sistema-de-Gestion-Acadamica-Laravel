<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'El nombre no debe contener números.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser negativa.',
            'age.max' => 'La edad no puede ser mayor a 80.',
            'email.ends_with' => 'El correo debe terminar en .com',
        ];
    }

    public function rules(): array
    {
        $studentId = $this->route('student')->id;
        $userId = $this->route('student')->user_id;

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($userId), 'ends_with:.com'],
            'phone' => ['nullable', 'string', 'max:20'],
            'student_code' => ['required', 'string', 'max:20', Rule::unique('students', 'student_code')->ignore($studentId)],
            'age' => ['nullable', 'integer', 'min:0', 'max:80'],
            'enrollment_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'graduated', 'suspended', 'withdrawn'])],
        ];
    }
}
