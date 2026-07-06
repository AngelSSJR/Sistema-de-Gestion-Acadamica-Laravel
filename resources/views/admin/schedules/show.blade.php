@extends('layouts.app')

@section('title', 'Detalle del Horario')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-calendar-week text-info me-2"></i>Detalle del Horario
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route($routePrefix . 'schedules.edit', $schedule) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route($routePrefix . 'schedules.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <dl>
                        <dt>Curso</dt>
                        <dd class="fs-5">{{ $schedule->course->name }} ({{ $schedule->course->code }})</dd>
                        <dt>Materia</dt>
                        <dd class="fs-5">{{ $schedule->subject->name }}</dd>
                        <dt>Profesor</dt>
                        <dd>{{ $schedule->teacher->user->name }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt>Días</dt>
                        <dd>@php $days = ['monday'=>'Lunes','tuesday'=>'Martes','wednesday'=>'Miércoles','thursday'=>'Jueves','friday'=>'Viernes','saturday'=>'Sábado'];
                            $selectedDays = is_array($schedule->day_of_week) ? $schedule->day_of_week : [$schedule->day_of_week];
                        @endphp
                            @foreach($selectedDays as $d)
                                <span class="badge bg-secondary fs-6 me-1">{{ $days[$d] ?? $d }}</span>
                            @endforeach
                        </dd>
                        <dt>Horario</dt>
                        <dd><strong>{{ substr($schedule->start_time, 0, 5) }} — {{ substr($schedule->end_time, 0, 5) }}</strong></dd>
                        <dt>Ambiente</dt>
                        <dd>
                            @if($schedule->room_id && $schedule->relationLoaded('room') && $schedule->room)
                                <a href="{{ route($routePrefix . 'rooms.show', $schedule->room) }}" class="text-decoration-none">{{ $schedule->room->name }}</a>
                            @elseif($schedule->room)
                                {{ $schedule->room }}
                            @else
                                —
                            @endif
                        </dd>
                        <dt>Período Académico</dt>
                        <dd>{{ $schedule->academic_period ?? '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
