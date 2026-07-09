<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $teachers = Teacher::with('user', 'subjects')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('employee_code', 'like', "%{$search}%")
                          ->orWhereHas('user', fn($q2) => $q2->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(15);

        $routePrefix = $this->getRoutePrefix();
        return view('admin.teacher-subjects.index', compact('teachers', 'routePrefix', 'search'));
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('subjects');
        $availableSubjects = Subject::all();
        $routePrefix = $this->getRoutePrefix();
        return view('admin.teacher-subjects.edit', compact('teacher', 'availableSubjects', 'routePrefix'));
    }

    public function attach(Teacher $teacher)
    {
        $prefix = $this->getRoutePrefix();
        $teacher->subjects()->attach(request('subject_id'));

        return redirect()->route("{$prefix}teacher-subjects.edit", $teacher)
            ->with('success', 'Materia asignada al profesor.');
    }

    public function detach(Teacher $teacher, Subject $subject)
    {
        $prefix = $this->getRoutePrefix();
        $teacher->subjects()->detach($subject->id);

        return redirect()->route("{$prefix}teacher-subjects.edit", $teacher)
            ->with('success', 'Materia removida del profesor.');
    }
}
