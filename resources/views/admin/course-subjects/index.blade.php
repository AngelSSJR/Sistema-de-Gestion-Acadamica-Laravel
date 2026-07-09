@extends('layouts.app')

@section('title', 'Asignar Materias a Cursos')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-diagram-3 text-warning me-2"></i>Asignación Materias - Cursos
        </h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @include('partials.search-form')
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Curso</th>
                            <th>Código</th>
                            <th>Materias Asignadas</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td class="fw-medium">{{ $course->name }}</td>
                                <td><span class="badge bg-warning text-dark">{{ $course->code }}</span></td>
                                <td>
                                    @if($course->subjects->count() > 0)
                                        @foreach($course->subjects as $subject)
                                            <span class="badge bg-info me-1">{{ $subject->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Sin materias</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'course-subjects.edit', $course) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil me-1"></i>Gestionar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay cursos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
