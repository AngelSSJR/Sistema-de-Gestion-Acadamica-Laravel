<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['enrollment.student.user', 'subject', 'teacher.user'])->latest()->paginate(20);
        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        $enrollments = Enrollment::with(['student.user', 'course'])->where('status', 'active')->get();
        $subjects = Subject::where('is_active', true)->get();
        $teachers = Teacher::with('user')->get();
        return view('admin.grades.create', compact('enrollments', 'subjects', 'teachers'));
    }

    public function store(StoreGradeRequest $request)
    {
        Grade::create($request->validated());

        return redirect()->route('dev-admin.grades.index')
            ->with('success', 'Calificación registrada exitosamente.');
    }

    public function show(Grade $grade)
    {
        $grade->load(['enrollment.student.user', 'enrollment.course', 'subject', 'teacher.user']);
        return view('admin.grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        $grade->load(['enrollment.student.user', 'enrollment.course', 'subject', 'teacher.user']);
        return view('admin.grades.edit', compact('grade'));
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->validated());

        return redirect()->route('dev-admin.grades.index')
            ->with('success', 'Calificación actualizada exitosamente.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('dev-admin.grades.index')
            ->with('success', 'Calificación eliminada exitosamente.');
    }
}
