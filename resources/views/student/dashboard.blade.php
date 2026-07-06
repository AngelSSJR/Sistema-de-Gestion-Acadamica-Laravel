@extends('layouts.app')

@section('title', 'Panel del Estudiante')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-mortarboard text-warning me-2"></i>Panel del Estudiante
            </h2>
        </div>

        @php
            $student = auth()->user()->student;
        @endphp

        @if($student)
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card bg-warning bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-person-vcard text-warning fs-1"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">Código</small>
                                    <h5 class="mb-0">{{ $student->student_code }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-book text-info fs-1"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">Materias Inscritas</small>
                                    <h5 class="mb-0">{{ $student->activeEnrollments->count() }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-check-circle text-success fs-1"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">Estado</small>
                                    <h5 class="mb-0">
                                        <span class="badge bg-success">{{ ucfirst($student->status) }}</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i>Mi Horario</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Consulta tu horario de clases semanal.</p>
                            <a href="{{ route('student.schedules.index') }}" class="btn btn-primary">Ver Horario</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Mis Calificaciones</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Revisa tu boletín de notas por período.</p>
                            <a href="{{ route('student.grades.index') }}" class="btn btn-success">Ver Notas</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle me-2"></i>
                No tienes un perfil de estudiante asociado. Contacta al administrador.
            </div>
        @endif
    </div>
@endsection
