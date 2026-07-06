<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
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
        ];
    }

    public function rules(): array
    {
        $teacherId = $this->route('teacher')->id;
        $userId = $this->route('teacher')->user_id;

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($userId), 'ends_with:.com'],
            'phone' => ['nullable', 'string', 'max:20'],
            'employee_code' => ['required', 'string', 'max:20', Rule::unique('teachers', 'employee_code')->ignore($teacherId)],
            'specialty' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'hire_date' => ['nullable', 'date'],
            'education_level' => ['nullable', 'string', 'max:50'],
        ];
    }
}
