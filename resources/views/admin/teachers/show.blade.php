@extends('layouts.app')

@section('title', 'Detalle del Profesor')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-person-badge text-info me-2"></i>{{ $teacher->user->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dev-admin.teachers.edit', $teacher) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route('dev-admin.teachers.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="bi bi-person-circle display-1 text-secondary mb-3"></i>
                    <h5>{{ $teacher->user->name }}</h5>
                    <span class="badge bg-primary mb-2">{{ $teacher->employee_code }}</span>
                    <p class="text-muted small mb-0">{{ $teacher->specialty ?? 'Sin especialidad' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $teacher->user->email }}</dd>
                        <dt class="col-sm-4">Teléfono</dt>
                        <dd class="col-sm-8">{{ $teacher->user->phone ?? '—' }}</dd>
                        <dt class="col-sm-4">Código Empleado</dt>
                        <dd class="col-sm-8">{{ $teacher->employee_code }}</dd>
                        <dt class="col-sm-4">Especialidad</dt>
                        <dd class="col-sm-8">{{ $teacher->specialty ?? '—' }}</dd>
                        <dt class="col-sm-4">Nivel Educativo</dt>
                        <dd class="col-sm-8">{{ $teacher->education_level ?? '—' }}</dd>
                        <dt class="col-sm-4">Fecha Contratación</dt>
                        <dd class="col-sm-8">{{ $teacher->hire_date?->format('d/m/Y') ?? '—' }}</dd>
                        <dt class="col-sm-4">Registrado</dt>
                        <dd class="col-sm-8">{{ $teacher->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-journal-bookmark-fill me-2"></i>Materias Asignadas</h5>
                </div>
                <div class="card-body">
                    @if($teacher->subjects->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($teacher->subjects as $subject)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $subject->name }}
                                    <span class="badge bg-secondary">{{ $subject->code }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">Este profesor no tiene materias asignadas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
