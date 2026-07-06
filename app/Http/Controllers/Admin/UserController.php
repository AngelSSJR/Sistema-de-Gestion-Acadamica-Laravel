<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', 'unique:' . User::class, 'ends_with:.com'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', Rule::in(['dev_admin', 'secretary', 'coordinator', 'teacher', 'student', 'rector'])],
            'employee_code' => ['required_if:role,teacher', 'nullable', 'string', 'max:20', Rule::unique('teachers', 'employee_code')],
            'specialty' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'education_level' => ['nullable', 'string', 'max:50'],
            'student_code' => ['required_if:role,student', 'nullable', 'string', 'max:20', Rule::unique('students', 'student_code')],
            'age' => ['nullable', 'integer', 'min:0', 'max:80'],
        ], [
            'name.regex' => 'El nombre no debe contener números.',
            'email.ends_with' => 'El correo debe terminar en .com',
            'employee_code.required_if' => 'El código de empleado es obligatorio para profesores.',
            'student_code.required_if' => 'El código de estudiante es obligatorio para estudiantes.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'email_verified_at' => now(),
        ]);

        $user->assignRole($validated['role']);

        if ($validated['role'] === 'teacher') {
            Teacher::create([
                'user_id' => $user->id,
                'employee_code' => $validated['employee_code'],
                'specialty' => $validated['specialty'] ?? null,
                'education_level' => $validated['education_level'] ?? null,
            ]);
        }

        if ($validated['role'] === 'student') {
            Student::create([
                'user_id' => $user->id,
                'student_code' => $validated['student_code'],
                'age' => $validated['age'] ?? null,
                'status' => 'active',
            ]);
        }

        return redirect()->route('dev-admin.users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user): View
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $user->load('roles');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($user->id), 'ends_with:.com'],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', Rule::in(['dev_admin', 'secretary', 'coordinator', 'teacher', 'student', 'rector'])],
        ], [
            'name.regex' => 'El nombre no debe contener números.',
            'email.ends_with' => 'El correo debe terminar en .com',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        if ($validated['password']) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        if ($validated['role'] !== $user->roles->first()?->name) {
            $user->syncRoles([$validated['role']]);
        }

        return redirect()->route('dev-admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->teacher) $user->teacher->delete();
        if ($user->student) $user->student->delete();
        $user->delete();

        return redirect()->route('dev-admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
