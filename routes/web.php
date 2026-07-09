<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseSubjectController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherSubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;
use App\Http\Controllers\Student\ScheduleController as StudentScheduleController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\GradeController as TeacherGradeController;
use App\Http\Controllers\Teacher\ScheduleController as TeacherScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/universidad', 'universidad')->name('universidad');

Route::get('/dashboard', function () {
    $user = auth()->user();
    return $user ? redirect()->route($user->getDashboardRoute()) : redirect()->route('login');
})->middleware(['auth'])->name('dashboard');

// ─────────────────── Desarrollador/Administrador ───────────────────
Route::middleware(['auth', 'role:dev_admin'])->prefix('dev-admin')->name('dev-admin.')->group(function () {
    Route::get('/dashboard', fn() => view('dev-admin.dashboard'))->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('attendances', AttendanceController::class);

    Route::get('course-subjects', [CourseSubjectController::class, 'index'])->name('course-subjects.index');
    Route::get('course-subjects/{course}', [CourseSubjectController::class, 'edit'])->name('course-subjects.edit');
    Route::post('course-subjects/{course}/attach', [CourseSubjectController::class, 'attach'])->name('course-subjects.attach');
    Route::delete('course-subjects/{course}/detach/{subject}', [CourseSubjectController::class, 'detach'])->name('course-subjects.detach');

    Route::get('teacher-subjects', [TeacherSubjectController::class, 'index'])->name('teacher-subjects.index');
    Route::get('teacher-subjects/{teacher}', [TeacherSubjectController::class, 'edit'])->name('teacher-subjects.edit');
    Route::post('teacher-subjects/{teacher}/attach', [TeacherSubjectController::class, 'attach'])->name('teacher-subjects.attach');
    Route::delete('teacher-subjects/{teacher}/detach/{subject}', [TeacherSubjectController::class, 'detach'])->name('teacher-subjects.detach');
});

// ─────────────────── Secretaría Académica ───────────────────
Route::middleware(['auth', 'role:secretary'])->prefix('secretary')->name('secretary.')->group(function () {
    Route::get('/dashboard', fn() => view('secretary.dashboard'))->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('enrollments', EnrollmentController::class);
});

// ─────────────────── Coordinador Académico ───────────────────
Route::middleware(['auth', 'role:coordinator'])->prefix('coordinator')->name('coordinator.')->group(function () {
    Route::get('/dashboard', fn() => view('coordinator.dashboard'))->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('schedules', ScheduleController::class);

    Route::get('course-subjects', [CourseSubjectController::class, 'index'])->name('course-subjects.index');
    Route::get('course-subjects/{course}', [CourseSubjectController::class, 'edit'])->name('course-subjects.edit');
    Route::post('course-subjects/{course}/attach', [CourseSubjectController::class, 'attach'])->name('course-subjects.attach');
    Route::delete('course-subjects/{course}/detach/{subject}', [CourseSubjectController::class, 'detach'])->name('course-subjects.detach');

    Route::get('teacher-subjects', [TeacherSubjectController::class, 'index'])->name('teacher-subjects.index');
    Route::get('teacher-subjects/{teacher}', [TeacherSubjectController::class, 'edit'])->name('teacher-subjects.edit');
    Route::post('teacher-subjects/{teacher}/attach', [TeacherSubjectController::class, 'attach'])->name('teacher-subjects.attach');
    Route::delete('teacher-subjects/{teacher}/detach/{subject}', [TeacherSubjectController::class, 'detach'])->name('teacher-subjects.detach');
});

// ─────────────────── Profesor ───────────────────
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', fn() => view('teacher.dashboard'))->name('dashboard');
    Route::get('/schedules', [TeacherScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/grades', [TeacherGradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/create', [TeacherGradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [TeacherGradeController::class, 'store'])->name('grades.store');
    Route::get('/attendances', [TeacherAttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create', [TeacherAttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [TeacherAttendanceController::class, 'store'])->name('attendances.store');
});

// ─────────────────── Estudiante ───────────────────
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', fn() => view('student.dashboard'))->name('dashboard');
    Route::get('/schedules', [StudentScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/grades', [StudentGradeController::class, 'index'])->name('grades.index');
});

// ─────────────────── Rector/Dirección ───────────────────
Route::middleware(['auth', 'role:rector'])->prefix('rector')->name('rector.')->group(function () {
    Route::get('/dashboard', fn() => view('rector.dashboard'))->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


