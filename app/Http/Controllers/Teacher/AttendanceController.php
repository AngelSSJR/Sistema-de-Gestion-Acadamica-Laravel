<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $schedules = $teacher->schedules()->with(['course', 'subject'])->orderBy('day_of_week')->orderBy('start_time')->get();
        return view('teacher.attendances.index', compact('schedules'));
    }

    public function create(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $request->validate([
            'schedule_id' => ['required', 'exists:schedules,id',
                Rule::exists('schedules', 'id')->where('teacher_id', $teacher->id),
            ],
            'date' => ['required', 'date'],
        ]);

        $schedule = Schedule::with(['course.activeStudents.user', 'subject'])->findOrFail($request->schedule_id);
        $date = $request->date;

        $students = $schedule->course->activeStudents;

        $existingAttendances = Attendance::where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');

        return view('teacher.attendances.create', compact('schedule', 'date', 'students', 'existingAttendances'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user()->teacher;
        $user = Auth::user();

        $request->validate([
            'schedule_id' => ['required', 'exists:schedules,id'],
            'date' => ['required', 'date'],
            'attendances' => ['required', 'array'],
            'attendances.*.student_id' => ['required', 'exists:students,id'],
            'attendances.*.status' => ['required', Rule::in(['present', 'absent', 'late', 'excused'])],
            'attendances.*.remark' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($request->attendances as $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $data['student_id'],
                    'schedule_id' => $request->schedule_id,
                    'date' => $request->date,
                ],
                [
                    'status' => $data['status'],
                    'remark' => $data['remark'] ?? null,
                    'registered_by' => $user->id,
                ]
            );
        }

        return redirect()->route('teacher.attendances.index')
            ->with('success', 'Asistencia registrada exitosamente.');
    }
}
