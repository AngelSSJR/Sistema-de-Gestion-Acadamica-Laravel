<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;

class CourseSubjectController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index()
    {
        $courses = Course::with('subjects')->latest()->paginate(15);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.course-subjects.index', compact('courses', 'routePrefix'));
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
