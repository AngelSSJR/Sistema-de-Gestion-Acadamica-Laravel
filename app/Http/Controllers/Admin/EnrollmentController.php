<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'secretary.';
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $enrollments = Enrollment::with(['student.user', 'course'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->whereHas('student.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })->orWhereHas('course', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })->orWhere('academic_period', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15);

        $routePrefix = $this->getRoutePrefix();
        return view('admin.enrollments.index', compact('enrollments', 'routePrefix', 'search'));
    }

    public function create()
    {
        $students = Student::with('user')->where('status', 'active')->get();
        $courses = Course::where('is_active', true)->get();
        $routePrefix = $this->getRoutePrefix();
        return view('admin.enrollments.create', compact('students', 'courses', 'routePrefix'));
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $prefix = $this->getRoutePrefix();
        Enrollment::create($request->validated());

        return redirect()->route("{$prefix}enrollments.index")
            ->with('success', 'Matrícula creada exitosamente.');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student.user', 'course.subjects', 'grades']);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.enrollments.show', compact('enrollment', 'routePrefix'));
    }

    public function edit(Enrollment $enrollment)
    {
        $courses = Course::where('is_active', true)->get();
        $routePrefix = $this->getRoutePrefix();
        return view('admin.enrollments.edit', compact('enrollment', 'courses', 'routePrefix'));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $prefix = $this->getRoutePrefix();
        $enrollment->update($request->validated());

        return redirect()->route("{$prefix}enrollments.index")
            ->with('success', 'Matrícula actualizada exitosamente.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $prefix = $this->getRoutePrefix();
        $enrollment->delete();
        return redirect()->route("{$prefix}enrollments.index")
            ->with('success', 'Matrícula eliminada exitosamente.');
    }
}
