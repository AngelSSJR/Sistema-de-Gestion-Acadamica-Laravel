@extends('layouts.app')

@section('title', 'Horarios')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-calendar-week text-info me-2"></i>Horarios
        </h2>
        <a href="{{ route($routePrefix . 'schedules.create') }}" class="btn btn-info text-white">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Horario
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Curso</th>
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Día</th>
                            <th>Horario</th>
                            <th>Aula</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->course->name }}</td>
                                <td>{{ $schedule->subject->name }}</td>
                                <td>{{ $schedule->teacher->user->name }}</td>
                                <td>
                                    @php
                                        $days = ['monday' => 'Lun', 'tuesday' => 'Mar', 'wednesday' => 'Mié', 'thursday' => 'Jue', 'friday' => 'Vie', 'saturday' => 'Sáb'];
                                        $selectedDays = is_array($schedule->day_of_week) ? $schedule->day_of_week : [$schedule->day_of_week];
                                    @endphp
                                    @foreach($selectedDays as $d)
                                        <span class="badge bg-secondary me-1">{{ $days[$d] ?? $d }}</span>
                                    @endforeach
                                </td>
                                <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                                <td>{{ $schedule->room?->name ?? $schedule->room ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'schedules.show', $schedule) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . 'schedules.edit', $schedule) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route($routePrefix . 'schedules.destroy', $schedule) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar este horario?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay horarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $schedules->links() }}
        </div>
    </div>
</div>
@endsection
