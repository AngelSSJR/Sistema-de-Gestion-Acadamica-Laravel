@extends('layouts.app')

@section('title', 'Profesores')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-people text-primary me-2"></i>Profesores
        </h2>
        <a href="{{ route('dev-admin.teachers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Profesor
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Especialidad</th>
                            <th>Teléfono</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $teacher->employee_code }}</span></td>
                                <td>
                                    <a href="{{ route('dev-admin.teachers.show', $teacher) }}" class="text-decoration-none fw-medium">
                                        {{ $teacher->user->name }}
                                    </a>
                                </td>
                                <td>{{ $teacher->user->email }}</td>
                                <td>{{ $teacher->specialty ?? '—' }}</td>
                                <td>{{ $teacher->user->phone ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('dev-admin.teachers.show', $teacher) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dev-admin.teachers.edit', $teacher) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('dev-admin.teachers.destroy', $teacher) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar este profesor? También se eliminará su usuario.')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
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
