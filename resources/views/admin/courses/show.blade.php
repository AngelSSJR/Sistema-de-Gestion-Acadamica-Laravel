@extends('layouts.app')

@section('title', 'Detalle del Curso')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-diagram-3 text-info me-2"></i>{{ $course->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route($routePrefix . 'courses.edit', $course) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route($routePrefix . 'courses.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <dl class="mb-0">
                        <dt>Código</dt>
                        <dd>{{ $course->code }}</dd>
                        <dt>Nivel</dt>
                        <dd>{{ $course->level ?? '—' }}</dd>
                        <dt>Sección</dt>
                        <dd>{{ $course->section ?? '—' }}</dd>
                        <dt>Año Académico</dt>
                        <dd>{{ $course->academic_year ?? '—' }}</dd>
                        <dt>Estado</dt>
                        <dd>
                            <span class="badge {{ $course->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $course->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </dd>
                        <dt>Estudiantes</dt>
                        <dd>{{ $course->activeStudents->count() }} activos</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-journal-bookmark-fill me-2"></i>Materias del Curso</h5>
                </div>
                <div class="card-body">
                    @if($course->subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr><th>Código</th><th>Materia</th><th>Créditos</th></tr>
                                </thead>
                                <tbody>
                                    @foreach($course->subjects as $subject)
                                        <tr>
                                            <td><span class="badge bg-secondary">{{ $subject->code }}</span></td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->credits }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">Este curso no tiene materias asignadas.</p>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i>Horarios</h5>
                </div>
                <div class="card-body">
                    @if($course->schedules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr><th>Materia</th><th>Profesor</th><th>Día</th><th>Hora</th><th>Aula</th></tr>
                                </thead>
                                <tbody>
                                    @php $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado']; @endphp
                                    @foreach($course->schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->subject->name }}</td>
                                            <td>{{ $schedule->teacher->user->name }}</td>
                                            <td>@foreach(is_array($schedule->day_of_week) ? $schedule->day_of_week : [$schedule->day_of_week] as $d)<span class="badge bg-secondary me-1">{{ $days[$d] ?? ucfirst($d) }}</span>@endforeach</td>
                                            <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                            <td>{{ $schedule->room ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No hay horarios definidos.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
