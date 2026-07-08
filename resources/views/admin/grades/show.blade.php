@extends('layouts.app')

@section('title', 'Detalle de Calificación')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-bar-chart text-info me-2"></i>Detalle de Calificación
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dev-admin.grades.edit', $grade) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route('dev-admin.grades.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person me-2"></i>Estudiante</h5>
                </div>
                <div class="card-body">
                    <h5>{{ $grade->enrollment->student->user->name }}</h5>
                    <p class="text-muted mb-1"><strong>Código:</strong> {{ $grade->enrollment->student->student_code }}</p>
                    <p class="text-muted mb-0"><strong>Curso:</strong> {{ $grade->enrollment->course->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Calificación</h5>
                </div>
                <div class="card-body">
                    <dl class="mb-0">
                        <dt>Materia</dt>
                        <dd>{{ $grade->subject->name }} ({{ $grade->subject->code }})</dd>
                        <dt>Profesor</dt>
                        <dd>{{ $grade->teacher->user->name }}</dd>
                        <dt>Período</dt>
                        <dd>{{ $grade->period }}</dd>
                        <dt>Nota</dt>
                        <dd>
                            <strong class="{{ $grade->grade_value && $grade->grade_value < 55 ? 'text-danger' : 'text-success' }}" style="font-size:1.4rem">
                                {{ $grade->grade_value ?? '—' }}
                            </strong>
                            <span class="text-muted">/ 20</span>
                        </dd>
                        <dt>Comentario</dt>
                        <dd>{{ $grade->comment ?? '—' }}</dd>
                        <dt>Período Académico</dt>
                        <dd>{{ $grade->academic_period ?? '—' }}</dd>
                        <dt>Registrado</dt>
                        <dd>{{ $grade->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
