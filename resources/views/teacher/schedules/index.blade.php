@extends('layouts.app')

@section('title', 'Mi Horario')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-calendar-week text-primary me-2"></i>Mi Horario Semanal
        </h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @php
                $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado'];
            @endphp
            @if($schedules->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th style="width:100px">Día</th>
                                <th>Horario</th>
                                <th>Curso</th>
                                <th>Materia</th>
                                <th>Aula</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td><strong>{{ $days[$schedule->day_of_week] ?? $schedule->day_of_week }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    <td>{{ $schedule->course->name }}</td>
                                    <td>{{ $schedule->subject->name }}</td>
                                    <td>{{ $schedule->room ?? '—' }}</td>
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
