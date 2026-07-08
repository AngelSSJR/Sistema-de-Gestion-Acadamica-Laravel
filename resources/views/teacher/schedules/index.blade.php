@extends('layouts.app')

@section('title', 'Mi Horario')

@php
    $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado'];
@endphp

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-calendar-week text-primary me-2"></i>Mi Horario Semanal
        </h2>
        <button id="toggleAmbiente" class="btn btn-outline-primary">
            <i class="bi bi-building me-1"></i>Mi Ambiente
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($schedules->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="horarioCompleto">
                        <thead class="table-primary">
                            <tr>
                                <th style="width:100px">Días</th>
                                <th class="col-horario">Horario</th>
                                <th class="col-curso">Curso</th>
                                <th>Materia</th>
                                <th>Ambiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>@foreach(is_array($schedule->day_of_week) ? $schedule->day_of_week : [$schedule->day_of_week] as $d)<span class="badge bg-secondary me-1">{{ $days[$d] ?? $d }}</span>@endforeach</td>
                                    <td class="col-horario">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    <td class="col-curso">{{ $schedule->course->name }}</td>
                                    <td>{{ $schedule->subject->name }}</td>
                                    <td>{{ $schedule->roomModel?->name ?? $schedule->room ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle d-none" id="tablaAmbiente">
                        <thead class="table-primary">
                            <tr>
                                <th style="width:100px">Días</th>
                                <th>Materia</th>
                                <th>Ambiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>@foreach(is_array($schedule->day_of_week) ? $schedule->day_of_week : [$schedule->day_of_week] as $d)<span class="badge bg-secondary me-1">{{ $days[$d] ?? $d }}</span>@endforeach</td>
                                    <td>{{ $schedule->subject->name }}</td>
                                    <td>{{ $schedule->roomModel?->name ?? $schedule->room ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-4">
                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                    No tienes horarios asignados.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('toggleAmbiente')?.addEventListener('click', function () {
        const completa = document.getElementById('horarioCompleto');
        const ambiente = document.getElementById('tablaAmbiente');
        if (!completa || !ambiente) return;
        const isAmbiente = !ambiente.classList.contains('d-none');
        completa.classList.toggle('d-none', !isAmbiente);
        ambiente.classList.toggle('d-none', isAmbiente);
        this.innerHTML = isAmbiente
            ? '<i class="bi bi-building me-1"></i>Mi Ambiente'
            : '<i class="bi bi-calendar-week me-1"></i>Horario Completo';
    });
</script>
@endpush
