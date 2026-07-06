<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Course;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;

class ScheduleController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index()
    {
        $schedules = Schedule::with(['course', 'subject', 'teacher.user', 'room'])->latest()->paginate(15);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.schedules.index', compact('schedules', 'routePrefix'));
    }

    public function create()
    {
        $courses = Course::where('is_active', true)->get();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();
        $rooms = Room::where('is_active', true)->get();
        $routePrefix = $this->getRoutePrefix();
        return view('admin.schedules.create', compact('courses', 'subjects', 'teachers', 'rooms', 'routePrefix'));
    }

    public function store(StoreScheduleRequest $request)
    {
        $prefix = $this->getRoutePrefix();
        Schedule::create($request->validated());

        return redirect()->route("{$prefix}schedules.index")
            ->with('success', 'Horario creado exitosamente.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['course', 'subject', 'teacher.user', 'room']);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.schedules.show', compact('schedule', 'routePrefix'));
    }

    public function edit(Schedule $schedule)
    {
        $courses = Course::where('is_active', true)->get();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();
        $rooms = Room::where('is_active', true)->get();
        $routePrefix = $this->getRoutePrefix();
        return view('admin.schedules.edit', compact('schedule', 'courses', 'subjects', 'teachers', 'rooms', 'routePrefix'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $prefix = $this->getRoutePrefix();
        $schedule->update($request->validated());

        return redirect()->route("{$prefix}schedules.index")
            ->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy(Schedule $schedule)
    {
        $prefix = $this->getRoutePrefix();
        $schedule->delete();
        return redirect()->route("{$prefix}schedules.index")
            ->with('success', 'Horario eliminado exitosamente.');
    }
}
