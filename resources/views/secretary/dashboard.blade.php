@extends('layouts.app')

@section('title', 'Secretaría Académica')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-file-earmark-text text-primary me-2"></i>Panel de Secretaría Académica
            </h2>
        </div>

        <div class="row g-4 mb-4">
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
                                <h6 class="card-subtitle mb-1 text-white-50">Matrículas Activas</h6>
                                <h2 class="mb-0">{{ \App\Models\Enrollment::where('status', 'active')->count() }}</h2>
                            </div>
                            <i class="bi bi-file-earmark-plus display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Cursos Disponibles</h6>
                                <h2 class="mb-0">{{ \App\Models\Course::where('is_active', true)->count() }}</h2>
                            </div>
                            <i class="bi bi-diagram-3 display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Expedientes</h6>
                                <h2 class="mb-0">{{ \App\Models\Student::count() }}</h2>
                            </div>
                            <i class="bi bi-folder-open display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-mortarboard me-2 text-success"></i>Gestión de Estudiantes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="{{ route('secretary.students.create') }}" class="btn btn-success w-100 p-3">
                                    <i class="bi bi-person-plus d-block fs-4 mb-2"></i>
                                    Registrar Estudiante
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('secretary.students.index') }}" class="btn btn-outline-success w-100 p-3">
                                    <i class="bi bi-people d-block fs-4 mb-2"></i>
                                    Ver Estudiantes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-file-earmark-plus me-2 text-warning"></i>Gestión de Matrículas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="{{ route('secretary.enrollments.create') }}" class="btn btn-warning w-100 p-3">
                                    <i class="bi bi-file-earmark-plus d-block fs-4 mb-2"></i>
                                    Nueva Matrícula
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('secretary.enrollments.index') }}" class="btn btn-outline-warning w-100 p-3">
                                    <i class="bi bi-list-check d-block fs-4 mb-2"></i>
                                    Ver Matrículas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-folder-open me-2 text-primary"></i>Expedientes Académicos</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Consulte el historial académico completo de un estudiante, incluyendo materias cursadas, calificaciones y estado de matrícula.</p>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('secretary.students.index') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o código...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>Buscar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
