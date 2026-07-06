<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $subjects = $teacher->subjects;
        $schedules = $teacher->schedules()->with('course')->get()->groupBy('subject_id');
        return view('teacher.grades.index', compact('teacher', 'subjects', 'schedules'));
    }

    public function create(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $request->validate([
            'subject_id' => ['required', 'exists:subjects,id',
                Rule::exists('teacher_subject', 'subject_id')->where('teacher_id', $teacher->id),
            ],
            'period' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        $subject = Subject::findOrFail($request->subject_id);
        $period = $request->period;

        $schedules = $teacher->schedules()->where('subject_id', $subject->id)->with('course.activeStudents.user')->get();
        $courses = $schedules->pluck('course')->unique('id');
        $students = collect();
        foreach ($courses as $course) {
            $students = $students->merge($course->activeStudents);
        }
        $students = $students->unique('id');

        $existingGrades = Grade::where('subject_id', $subject->id)
            ->where('teacher_id', $teacher->id)
            ->where('period', $period)
            ->get()
            ->keyBy('enrollment_id');

        return view('teacher.grades.create', compact('teacher', 'subject', 'period', 'students', 'courses', 'existingGrades'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $request->validate([
            'subject_id' => ['required', 'exists:subjects,id'],
            'period' => ['required', 'integer', 'min:1', 'max:6'],
            'grades' => ['required', 'array'],
            'grades.*.enrollment_id' => ['required', 'exists:enrollments,id'],
            'grades.*.grade_value' => ['nullable', 'numeric', 'min:0', 'max:20'],
            'grades.*.comment' => ['nullable', 'string', 'max:500'],
            'academic_period' => ['nullable', 'string', 'max:20'],
        ]);

        $subjectId = $request->subject_id;
        $period = $request->period;
        $academicPeriod = $request->academic_period ?? now()->format('Y') . '-' . (now()->format('Y') + 1);

        foreach ($request->grades as $data) {
            Grade::updateOrCreate(
                [
                    'enrollment_id' => $data['enrollment_id'],
                    'subject_id' => $subjectId,
                    'teacher_id' => $teacher->id,
                    'period' => $period,
                ],
                [
                    'grade_value' => $data['grade_value'] ?? null,
                    'comment' => $data['comment'] ?? null,
                    'academic_period' => $academicPeriod,
                ]
            );
        }

        return redirect()->route('teacher.grades.index')
            ->with('success', 'Calificaciones guardadas exitosamente.');
    }
}
