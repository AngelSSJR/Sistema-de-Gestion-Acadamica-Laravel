<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $enrollments = $student->enrollments()->where('status', 'active')->with('course.schedules.subject', 'course.schedules.teacher.user', 'course.schedules.roomModel')->get();
        $schedules = collect();
        foreach ($enrollments as $enrollment) {
            $schedules = $schedules->merge($enrollment->course->schedules);
        }
        $schedules = $schedules->sortBy(['day_of_week', 'start_time']);
        return view('student.schedules.index', compact('schedules'));
    }
}
