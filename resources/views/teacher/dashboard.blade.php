@extends('layouts.app')

@section('title', 'Panel del Profesor')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-person-badge text-success me-2"></i>Panel del Profesor
            </h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-week display-6 text-primary mb-3"></i>
                        <h5>Mi Horario</h5>
                        <p class="text-muted small">Consulta tu horario de clases semanal</p>
                        <a href="{{ route('teacher.schedules.index') }}" class="btn btn-primary btn-sm">Ver Horario</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-bar-chart display-6 text-warning mb-3"></i>
                        <h5>Calificaciones</h5>
                        <p class="text-muted small">Registra y modifica notas de tus estudiantes</p>
                        <a href="{{ route('teacher.grades.index') }}" class="btn btn-warning btn-sm">Gestionar Notas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-check-square display-6 text-info mb-3"></i>
                        <h5>Asistencia</h5>
                        <p class="text-muted small">Toma la asistencia diaria de tus clases</p>
                        <a href="{{ route('teacher.attendances.index') }}" class="btn btn-info btn-sm">Tomar Asistencia</a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $teacher = auth()->user()->teacher;
        @endphp

        @if($teacher)
            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Mis Materias</h5>
                </div>
                <div class="card-body">
                    @if($teacher->subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Código</th>
                                        <th>Materia</th>
                                        <th>Créditos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teacher->subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->code }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->credits }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No tienes materias asignadas.</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
