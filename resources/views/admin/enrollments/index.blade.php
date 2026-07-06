@extends('layouts.app')

@section('title', 'Matrículas')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-file-earmark-plus text-primary me-2"></i>Matrículas
        </h2>
        <a href="{{ route($routePrefix . 'enrollments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Nueva Matrícula
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
                            <th>Período</th>
                            <th>Fecha Matrícula</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                            <tr>
                                <td>
                                    <a href="{{ route($routePrefix . 'enrollments.show', $enrollment) }}" class="text-decoration-none fw-medium">
                                        {{ $enrollment->student->user->name }}
                                    </a>
                                    <br><small class="text-muted">{{ $enrollment->student->student_code }}</small>
                                </td>
                                <td>{{ $enrollment->course->name }}</td>
                                <td><span class="badge bg-secondary">{{ $enrollment->academic_period }}</span></td>
                                <td>{{ $enrollment->enrollment_date?->format('d/m/Y') ?? '—' }}</td>
                                <td>
                                    @php
                                        $map = ['active' => 'bg-success', 'completed' => 'bg-primary', 'withdrawn' => 'bg-danger'];
                                    @endphp
                                    <span class="badge {{ $map[$enrollment->status] ?? 'bg-secondary' }}">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'enrollments.show', $enrollment) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . 'enrollments.edit', $enrollment) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route($routePrefix . 'enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar esta matrícula?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay matrículas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $enrollments->links() }}
        </div>
    </div>
</div>
@endsection
