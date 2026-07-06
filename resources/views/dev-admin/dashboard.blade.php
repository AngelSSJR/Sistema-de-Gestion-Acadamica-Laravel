@extends('layouts.app')

@section('title', 'Panel de Desarrollo')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-shield-lock text-danger me-2"></i>Panel de Desarrollo y Administración
            </h2>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-dark text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">Usuarios</h6>
                                <h2 class="mb-0">{{ \App\Models\User::count() }}</h2>
                            </div>
                            <i class="bi bi-people display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white h-100">
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
                <div class="card bg-info text-white h-100">
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
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Acciones Rápidas</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('dev-admin.users.create') }}" class="btn btn-dark w-100 p-3">
                            <i class="bi bi-person-plus d-block fs-4 mb-2"></i>
                            Nuevo Usuario
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('dev-admin.teachers.create') }}" class="btn btn-outline-primary w-100 p-3">
                            <i class="bi bi-person-badge d-block fs-4 mb-2"></i>
                            Nuevo Profesor
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('dev-admin.students.create') }}" class="btn btn-outline-success w-100 p-3">
                            <i class="bi bi-mortarboard d-block fs-4 mb-2"></i>
                            Nuevo Estudiante
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('dev-admin.enrollments.create') }}" class="btn btn-outline-warning w-100 p-3">
                            <i class="bi bi-file-earmark-plus d-block fs-4 mb-2"></i>
                            Nueva Matrícula
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
