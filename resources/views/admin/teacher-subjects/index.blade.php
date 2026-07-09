@extends('layouts.app')

@section('title', 'Asignar Materias a Profesores')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-people text-primary me-2"></i>Asignación Materias - Profesores
        </h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @include('partials.search-form')
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Profesor</th>
                            <th>Código</th>
                            <th>Especialidad</th>
                            <th>Materias Asignadas</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>
                                <td class="fw-medium">{{ $teacher->user->name }}</td>
                                <td><span class="badge bg-secondary">{{ $teacher->employee_code }}</span></td>
                                <td>{{ $teacher->specialty ?? '—' }}</td>
                                <td>
                                    @if($teacher->subjects->count() > 0)
                                        @foreach($teacher->subjects as $subject)
                                            <span class="badge bg-info me-1">{{ $subject->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Sin materias</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'teacher-subjects.edit', $teacher) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil me-1"></i>Gestionar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay profesores registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $teachers->links() }}
        </div>
    </div>
</div>
@endsection
