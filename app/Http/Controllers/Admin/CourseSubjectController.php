<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseSubjectController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $courses = Course::with('subjects')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15);

        $routePrefix = $this->getRoutePrefix();
        return view('admin.course-subjects.index', compact('courses', 'routePrefix', 'search'));
    }

    public function edit(Course $course)
    {
        $course->load('subjects');
        $availableSubjects = Subject::all();
        $routePrefix = $this->getRoutePrefix();
        return view('admin.course-subjects.edit', compact('course', 'availableSubjects', 'routePrefix'));
    }

    public function attach(Course $course)
    {
        $prefix = $this->getRoutePrefix();
        $course->subjects()->attach(request('subject_id'));

        return redirect()->route("{$prefix}course-subjects.edit", $course)
            ->with('success', 'Materia asignada al curso.');
    }

    public function detach(Course $course, Subject $subject)
    {
        $prefix = $this->getRoutePrefix();
        $course->subjects()->detach($subject->id);

        return redirect()->route("{$prefix}course-subjects.edit", $course)
            ->with('success', 'Materia removida del curso.');
    }
}
