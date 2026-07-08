<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'El nombre no debe contener números.',
            'specialty.regex' => 'La especialidad no debe contener números.',
            'email.ends_with' => 'El correo debe terminar en .com',
            'phone.regex' => 'El teléfono solo puede contener números, espacios, +, - y paréntesis.',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', Rule::unique('users', 'email'), 'ends_with:.com'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[\d\s+\-()]+$/'],
            'employee_code' => ['required', 'string', 'max:20', Rule::unique('teachers', 'employee_code')],
            'specialty' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'hire_date' => ['nullable', 'date'],
            'education_level' => ['nullable', 'string', 'max:50'],
        ];
    }
}
