@extends('layouts.app')

@section('title', 'Calificaciones')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-bar-chart text-success me-2"></i>Calificaciones
        </h2>
        <a href="{{ route('dev-admin.grades.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i>Nueva Calificación
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Estudiante</th>
                            <th>Curso</th>
                            <th>Materia</th>
                            <th>Período</th>
                            <th>Nota</th>
                            <th>Profesor</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $grade)
                            <tr>
                                <td>
                                    <a href="{{ route('dev-admin.grades.show', $grade) }}" class="text-decoration-none fw-medium">
                                        {{ $grade->enrollment->student->user->name }}
                                    </a>
                                </td>
                                <td>{{ $grade->enrollment->course->name }}</td>
                                <td>{{ $grade->subject->name }}</td>
                                <td><span class="badge bg-info">{{ $grade->period }}</span></td>
                                <td>
                                    <strong class="{{ $grade->grade_value && $grade->grade_value < 11 ? 'text-danger' : 'text-success' }}">
                                        {{ $grade->grade_value ?? '—' }}
                                    </strong>
                                </td>
                                <td>{{ $grade->teacher->user->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('dev-admin.grades.show', $grade) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dev-admin.grades.edit', $grade) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('dev-admin.grades.destroy', $grade) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar esta calificación?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay calificaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $grades->links() }}
        </div>
    </div>
</div>
@endsection
