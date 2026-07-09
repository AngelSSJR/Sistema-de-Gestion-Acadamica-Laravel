<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $attendances = Attendance::with(['student.user', 'schedule.course', 'schedule.subject', 'registrar'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('student.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('schedule.course', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('schedule.subject', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()->paginate(20);

        return view('admin.attendances.index', compact('attendances', 'search'));
    }

    public function create()
    {
        $schedules = Schedule::with(['course', 'subject', 'teacher.user'])->latest()->get();
        $students = Student::with('user')->where('status', 'active')->get();
        return view('admin.attendances.create', compact('schedules', 'students'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        Attendance::create(array_merge($request->validated(), [
            'registered_by' => auth()->id(),
        ]));

        return redirect()->route('dev-admin.attendances.index')
            ->with('success', 'Asistencia registrada exitosamente.');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['student.user', 'schedule.course', 'schedule.subject', 'schedule.teacher.user', 'registrar']);
        return view('admin.attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $attendance->load(['student.user', 'schedule.course', 'schedule.subject']);
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());

        return redirect()->route('dev-admin.attendances.index')
            ->with('success', 'Asistencia actualizada exitosamente.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('dev-admin.attendances.index')
            ->with('success', 'Asistencia eliminada exitosamente.');
    }
}
