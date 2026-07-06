<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $enrollments = $student->enrollments()->where('status', 'active')->with('course.subjects', 'grades.subject')->get();
        return view('student.grades.index', compact('student', 'enrollments'));
    }
}
