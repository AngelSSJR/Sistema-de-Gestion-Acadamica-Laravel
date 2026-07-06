<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'secretary.';
    }

    public function index()
    {
        $students = Student::with('user')->latest()->paginate(10);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.students.index', compact('students', 'routePrefix'));
    }

    public function create()
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.students.create', compact('routePrefix'));
    }

    public function store(StoreStudentRequest $request)
    {
        $prefix = $this->getRoutePrefix();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);
        $user->assignRole('student');

        Student::create([
            'user_id' => $user->id,
            'student_code' => $request->student_code,
            'age' => $request->age,
            'enrollment_date' => $request->enrollment_date,
            'status' => $request->status,
        ]);

        return redirect()->route("{$prefix}students.index")
            ->with('success', 'Estudiante creado exitosamente.');
    }

    public function show(Student $student)
    {
        $student->load('user', 'enrollments.course', 'enrollments.grades');
        $routePrefix = $this->getRoutePrefix();
        return view('admin.students.show', compact('student', 'routePrefix'));
    }

    public function edit(Student $student)
    {
        $student->load('user');
        $routePrefix = $this->getRoutePrefix();
        return view('admin.students.edit', compact('student', 'routePrefix'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $prefix = $this->getRoutePrefix();

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $student->update([
            'student_code' => $request->student_code,
            'age' => $request->age,
            'enrollment_date' => $request->enrollment_date,
            'status' => $request->status,
        ]);

        return redirect()->route("{$prefix}students.index")
            ->with('success', 'Estudiante actualizado exitosamente.');
    }

    public function destroy(Student $student)
    {
        $prefix = $this->getRoutePrefix();

        $student->delete();
        $student->user->delete();
        return redirect()->route("{$prefix}students.index")
            ->with('success', 'Estudiante eliminado exitosamente.');
    }
}
