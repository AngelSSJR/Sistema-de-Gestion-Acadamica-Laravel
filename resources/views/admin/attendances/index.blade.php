@extends('layouts.app')

@section('title', 'Asistencias')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-check-square text-info me-2"></i>Asistencias
        </h2>
        <a href="{{ route('dev-admin.attendances.create') }}" class="btn btn-info text-white">
            <i class="bi bi-plus-lg me-1"></i>Nueva Asistencia
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
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Registrado por</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr>
                                <td>
                                    <a href="{{ route('dev-admin.attendances.show', $attendance) }}" class="text-decoration-none fw-medium">
                                        {{ $attendance->student->user->name }}
                                    </a>
                                </td>
                                <td>{{ $attendance->schedule->course->name }}</td>
                                <td>{{ $attendance->schedule->subject->name }}</td>
                                <td>{{ $attendance->date->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $map = ['present' => 'bg-success', 'absent' => 'bg-danger', 'late' => 'bg-warning text-dark', 'excused' => 'bg-secondary'];
                                    @endphp
                                    <span class="badge {{ $map[$attendance->status] ?? 'bg-secondary' }}">
                                        {{ __(ucfirst($attendance->status)) }}
                                    </span>
                                </td>
                                <td>{{ $attendance->registrar->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('dev-admin.attendances.show', $attendance) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dev-admin.attendances.edit', $attendance) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('dev-admin.attendances.destroy', $attendance) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar este registro de asistencia?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay asistencias registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection
