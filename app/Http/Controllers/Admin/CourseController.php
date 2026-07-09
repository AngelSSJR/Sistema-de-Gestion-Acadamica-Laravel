<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $courses = Course::when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('level', 'like', "%{$search}%")
                  ->orWhere('section', 'like', "%{$search}%")
                  ->orWhere('academic_year', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        $routePrefix = $this->getRoutePrefix();
        return view('admin.courses.index', compact('courses', 'routePrefix', 'search'));
    }

    public function create()
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.courses.create', compact('routePrefix'));
    }

    public function store(StoreCourseRequest $request)
    {
        $prefix = $this->getRoutePrefix();
        Course::create($request->validated());

        return redirect()->route("{$prefix}courses.index")
            ->with('success', 'Curso creado exitosamente.');
    }

    public function show(Course $course)
    {
        $course->load('subjects', 'schedules.teacher', 'activeStudents.user');
        $routePrefix = $this->getRoutePrefix();
        return view('admin.courses.show', compact('course', 'routePrefix'));
    }

    public function edit(Course $course)
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.courses.edit', compact('course', 'routePrefix'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $prefix = $this->getRoutePrefix();
        $course->update($request->validated());

        return redirect()->route("{$prefix}courses.index")
            ->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(Course $course)
    {
        $prefix = $this->getRoutePrefix();
        $course->delete();
        return redirect()->route("{$prefix}courses.index")
            ->with('success', 'Curso eliminado exitosamente.');
    }
}
