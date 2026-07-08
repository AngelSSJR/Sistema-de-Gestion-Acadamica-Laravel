<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $schedules = $teacher->schedules()->with(['course', 'subject', 'roomModel'])->orderBy('day_of_week')->orderBy('start_time')->get();
        return view('teacher.schedules.index', compact('schedules'));
    }
}
