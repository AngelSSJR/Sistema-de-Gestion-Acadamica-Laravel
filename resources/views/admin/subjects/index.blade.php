@extends('layouts.app')

@section('title', 'Materias')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-journal-bookmark-fill text-info me-2"></i>Materias
        </h2>
        <a href="{{ route($routePrefix . 'subjects.create') }}" class="btn btn-info text-white">
            <i class="bi bi-plus-lg me-1"></i>Nueva Materia
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
                            <th>Créditos</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $subject)
                            <tr>
                                <td><span class="badge bg-info">{{ $subject->code }}</span></td>
                                <td>
                                    <a href="{{ route($routePrefix . 'subjects.show', $subject) }}" class="text-decoration-none fw-medium">
                                        {{ $subject->name }}
                                    </a>
                                </td>
                                <td>{{ $subject->credits }}</td>
                                <td>
                                    <span class="badge {{ $subject->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $subject->is_active ? 'Activa' : 'Inactiva' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'subjects.show', $subject) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . 'subjects.edit', $subject) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route($routePrefix . 'subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar esta materia?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay materias registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $subjects->links() }}
        </div>
    </div>
</div>
@endsection
