<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
            'age.max' => 'La edad no puede ser mayor a 60.',
            'phone.regex' => 'El teléfono solo puede contener números, espacios, +, - y paréntesis.',
            'email.ends_with' => 'El correo debe terminar en .com',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', Rule::unique('users', 'email'), 'ends_with:.com'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[\d\s+\-()]+$/'],
            'student_code' => ['required', 'string', 'max:20', Rule::unique('students', 'student_code')],
            'age' => ['nullable', 'integer', 'min:0', 'max:60'],
            'enrollment_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'graduated', 'suspended', 'withdrawn'])],
        ];
    }
}
