@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-diagram-3 text-warning me-2"></i>Cursos
        </h2>
        <a href="{{ route($routePrefix . 'courses.create') }}" class="btn btn-warning">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Curso
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @include('partials.search-form')
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Nivel</th>
                            <th>Sección</th>
                            <th>Año Académico</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td><span class="badge bg-warning text-dark">{{ $course->code }}</span></td>
                                <td>
                                    <a href="{{ route($routePrefix . 'courses.show', $course) }}" class="text-decoration-none fw-medium">
                                        {{ $course->name }}
                                    </a>
                                </td>
                                <td>{{ $course->level ?? '—' }}</td>
                                <td>{{ $course->section ?? '—' }}</td>
                                <td>{{ $course->academic_year ?? '—' }}</td>
                                <td>
                                    <span class="badge {{ $course->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $course->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'courses.show', $course) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . 'courses.edit', $course) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route($routePrefix . 'courses.destroy', $course) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar este curso?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
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
