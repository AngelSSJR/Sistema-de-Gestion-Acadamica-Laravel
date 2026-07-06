@extends('layouts.app')

@section('title', 'Coordinación Académica')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-diagram-3 text-primary me-2"></i>Panel de Coordinación Académica
            </h2>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Cursos</h6>
                                <h2 class="mb-0">{{ \App\Models\Course::count() }}</h2>
                            </div>
                            <i class="bi bi-diagram-3 display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Materias</h6>
                                <h2 class="mb-0">{{ \App\Models\Subject::count() }}</h2>
                            </div>
                            <i class="bi bi-journal-bookmark-fill display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Horarios</h6>
                                <h2 class="mb-0">{{ \App\Models\Schedule::count() }}</h2>
                            </div>
                            <i class="bi bi-calendar-week display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Profesores</h6>
                                <h2 class="mb-0">{{ \App\Models\Teacher::count() }}</h2>
                            </div>
                            <i class="bi bi-person-badge display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Planificación Académica</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('coordinator.courses.create') }}" class="btn btn-primary w-100 p-3">
                            <i class="bi bi-diagram-3 d-block fs-4 mb-2"></i>
                            Nuevo Curso
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('coordinator.subjects.create') }}" class="btn btn-success w-100 p-3">
                            <i class="bi bi-journal-plus d-block fs-4 mb-2"></i>
                            Nueva Materia
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('coordinator.schedules.create') }}" class="btn btn-warning w-100 p-3">
                            <i class="bi bi-calendar-plus d-block fs-4 mb-2"></i>
                            Nuevo Horario
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('coordinator.course-subjects.index') }}" class="btn btn-outline-primary w-100 p-3">
                            <i class="bi bi-link-45deg d-block fs-4 mb-2"></i>
                            Asignar Materias a Cursos
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('coordinator.teacher-subjects.index') }}" class="btn btn-outline-success w-100 p-3">
                            <i class="bi bi-person-plus d-block fs-4 mb-2"></i>
                            Asignar Materias a Profesores
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
