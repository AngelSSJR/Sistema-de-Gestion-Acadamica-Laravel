@extends('layouts.app')

@section('title', 'Panel del Rector')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-building text-danger me-2"></i>Panel de Dirección
            </h2>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Profesores</h6>
                                <h2 class="mb-0">{{ \App\Models\Teacher::count() }}</h2>
                            </div>
                            <i class="bi bi-people display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Estudiantes</h6>
                                <h2 class="mb-0">{{ \App\Models\Student::count() }}</h2>
                            </div>
                            <i class="bi bi-mortarboard display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white h-100">
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
                <div class="card bg-info text-white h-100">
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
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Resumen Institucional</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded">
                            <h6><i class="bi bi-file-earmark-text me-2"></i>Matrículas Activas</h6>
                            <p class="h3">{{ \App\Models\Enrollment::where('status', 'active')->count() }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded">
                            <h6><i class="bi bi-calendar-week me-2"></i>Horarios Registrados</h6>
                            <p class="h3">{{ \App\Models\Schedule::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
