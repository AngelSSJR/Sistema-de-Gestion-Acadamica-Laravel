@extends('layouts.app')

@section('title', 'Estudiantes')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-mortarboard text-success me-2"></i>Estudiantes
        </h2>
        <a href="{{ route($routePrefix . 'students.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Estudiante
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
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Fecha Ingreso</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td><span class="badge bg-success">{{ $student->student_code }}</span></td>
                                <td>
                                    <a href="{{ route($routePrefix . 'students.show', $student) }}" class="text-decoration-none fw-medium">
                                        {{ $student->user->name }}
                                    </a>
                                </td>
                                <td>{{ $student->user->email }}</td>
                                <td>
                                    @php
                                        $statusClasses = ['active' => 'bg-success', 'graduated' => 'bg-primary', 'suspended' => 'bg-warning text-dark', 'withdrawn' => 'bg-danger'];
                                    @endphp
                                    <span class="badge {{ $statusClasses[$student->status] ?? 'bg-secondary' }}">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </td>
                                <td>{{ $student->enrollment_date?->format('d/m/Y') ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'students.show', $student) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . 'students.edit', $student) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route($routePrefix . 'students.destroy', $student) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar este estudiante? También se eliminará su usuario.')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay estudiantes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection
