<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);
        $user->assignRole('teacher');

        Teacher::create([
            'user_id' => $user->id,
            'employee_code' => $request->employee_code,
            'specialty' => $request->specialty,
            'hire_date' => $request->hire_date,
            'education_level' => $request->education_level,
        ]);

        return redirect()->route('dev-admin.teachers.index')
            ->with('success', 'Profesor creado exitosamente.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user', 'subjects', 'schedules');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $teacher->update([
            'employee_code' => $request->employee_code,
            'specialty' => $request->specialty,
            'hire_date' => $request->hire_date,
            'education_level' => $request->education_level,
        ]);

        return redirect()->route('dev-admin.teachers.index')
            ->with('success', 'Profesor actualizado exitosamente.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        $teacher->user->delete();
        return redirect()->route('dev-admin.teachers.index')
            ->with('success', 'Profesor eliminado exitosamente.');
    }
}
