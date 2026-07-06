@extends('layouts.app')

@section('title', 'Detalle de la Materia')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-journal-bookmark-fill text-info me-2"></i>{{ $subject->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route($routePrefix . 'subjects.edit', $subject) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route($routePrefix . 'subjects.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <dl class="mb-0">
                        <dt>Código</dt>
                        <dd><span class="badge bg-info">{{ $subject->code }}</span></dd>
                        <dt>Créditos</dt>
                        <dd>{{ $subject->credits }}</dd>
                        <dt>Estado</dt>
                        <dd>
                            <span class="badge {{ $subject->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $subject->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                        </dd>
                        <dt>Descripción</dt>
                        <dd>{{ $subject->description ?? 'Sin descripción' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-people me-2"></i>Profesores Asignados</h5>
                </div>
                <div class="card-body">
                    @if($subject->teachers->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($subject->teachers as $teacher)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $teacher->user->name }}
                                    <span class="badge bg-secondary">{{ $teacher->employee_code }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">No hay profesores asignados a esta materia.</p>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>Cursos que la incluyen</h5>
                </div>
                <div class="card-body">
                    @if($subject->courses->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($subject->courses as $course)
                                <li class="list-group-item">{{ $course->name }} ({{ $course->code }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">Esta materia no está asignada a ningún curso.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
