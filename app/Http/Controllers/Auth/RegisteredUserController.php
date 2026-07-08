<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $baseRules = [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', 'unique:' . User::class, 'ends_with:.com'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[\d\s+\-()]+$/'],
            'role' => ['required', Rule::in(['teacher', 'student'])],
        ];

        $roleRules = match ($request->role) {
            'teacher' => [
                'employee_code' => ['required', 'string', 'max:20', Rule::unique('teachers', 'employee_code')],
                'specialty' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
                'education_level' => ['nullable', 'string', 'max:50'],
            ],
            'student' => [
                'student_code' => ['required', 'string', 'max:20', Rule::unique('students', 'student_code')],
                'age' => ['nullable', 'integer', 'min:0', 'max:60'],
            ],
            default => [],
        };

        $validated = $request->validate(array_merge($baseRules, $roleRules), [
            'name.regex' => 'El nombre no debe contener números.',
            'specialty.regex' => 'La especialidad no debe contener números.',
            'phone.regex' => 'El teléfono solo puede contener números, espacios, +, - y paréntesis.',
            'email.ends_with' => 'El correo debe terminar en .com',
            'email.unique' => 'El correo ya está registrado.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser negativa.',
            'age.max' => 'La edad no puede ser mayor a 60.',
            'employee_code.unique' => 'El código de empleado ya está registrado.',
            'student_code.unique' => 'El código de estudiante ya está registrado.',
            'role.in' => 'Seleccione un tipo de usuario válido.',
            'role.required' => 'Debe seleccionar si es Profesor o Estudiante.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
        ]);

        if ($request->role === 'teacher') {
            $user->assignRole('teacher');
            Teacher::create([
                'user_id' => $user->id,
                'employee_code' => $validated['employee_code'],
                'specialty' => $validated['specialty'] ?? null,
                'education_level' => $validated['education_level'] ?? null,
            ]);
        } else {
            $user->assignRole('student');
            Student::create([
                'user_id' => $user->id,
                'student_code' => $validated['student_code'],
                'age' => $validated['age'] ?? null,
                'status' => 'active',
            ]);
        }

        $user->forceFill(['email_verified_at' => now()])->save();
        event(new Registered($user));

        Auth::login($user, true);
        session()->save();

        return redirect('/');

    }
}
