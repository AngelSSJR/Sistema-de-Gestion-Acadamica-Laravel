<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index()
    {
        $subjects = Subject::latest()->paginate(10);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.subjects.index', compact('subjects', 'routePrefix'));
    }

    public function create()
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.subjects.create', compact('routePrefix'));
    }

    public function store(StoreSubjectRequest $request)
    {
        $prefix = $this->getRoutePrefix();
        Subject::create($request->validated());

        return redirect()->route("{$prefix}subjects.index")
            ->with('success', 'Materia creada exitosamente.');
    }

    public function show(Subject $subject)
    {
        $subject->load('courses');
        $routePrefix = $this->getRoutePrefix();
        return view('admin.subjects.show', compact('subject', 'routePrefix'));
    }

    public function edit(Subject $subject)
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.subjects.edit', compact('subject', 'routePrefix'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $prefix = $this->getRoutePrefix();
        $subject->update($request->validated());

        return redirect()->route("{$prefix}subjects.index")
            ->with('success', 'Materia actualizada exitosamente.');
    }

    public function destroy(Subject $subject)
    {
        $prefix = $this->getRoutePrefix();
        $subject->delete();
        return redirect()->route("{$prefix}subjects.index")
            ->with('success', 'Materia eliminada exitosamente.');
    }
}
