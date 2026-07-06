@extends('layouts.app')

@section('title', 'Gestionar Materias del Curso')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-diagram-3 text-warning me-2"></i>Materias: {{ $course->name }}
        </h2>
        <a href="{{ route($routePrefix . 'course-subjects.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-check-circle text-success me-2"></i>Materias Asignadas</h5>
                    <span class="badge bg-success">{{ $course->subjects->count() }}</span>
                </div>
                <div class="card-body">
                    @if($course->subjects->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($course->subjects as $subject)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <strong>{{ $subject->name }}</strong>
                                        <br><small class="text-muted">{{ $subject->code }} · {{ $subject->credits }} créditos</small>
                                    </span>
                                    <form action="{{ route($routePrefix . 'course-subjects.detach', [$course, $subject]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Remover {{ $subject->name }} del curso?')">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">Este curso no tiene materias asignadas.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-plus-circle text-primary me-2"></i>Agregar Materia</h5>
                    <span class="badge bg-primary">{{ $availableSubjects->count() }} disponibles</span>
                </div>
                <div class="card-body">
                    @if($availableSubjects->count() > 0)
                        <form action="{{ route($routePrefix . 'course-subjects.attach', $course) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <select class="form-select" name="subject_id" required>
                                    <option value="">Seleccionar materia...</option>
                                    @foreach($availableSubjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i>Asignar Materia
                            </button>
                        </form>
                    @else
                        <p class="text-muted mb-0">
                            <i class="bi bi-check-all me-1"></i>
                            Todas las materias disponibles ya están asignadas a este curso.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
