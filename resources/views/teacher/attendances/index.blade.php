@extends('layouts.app')

@section('title', 'Asistencia')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-check-square text-info me-2"></i>Asistencia
        </h2>
    </div>

    @if($schedules->count() > 0)
        <div class="row g-4">
            @foreach($schedules as $schedule)
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                {{ $schedule->subject->name }}
                                <span class="badge bg-secondary">{{ $schedule->course->name }}</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">
                                <i class="bi bi-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                | Aula: {{ $schedule->room ?? '—' }}
                            </p>
                            <form method="GET" action="{{ route('teacher.attendances.create') }}" class="row g-2">
                                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                <div class="col-8">
                                    <input type="date" name="date" class="form-control form-control-sm"
                                           value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-info btn-sm text-white w-100">
                                        <i class="bi bi-check-lg me-1"></i>Tomar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center text-muted py-4">
                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                No tienes horarios asignados.
            </div>
        </div>
    @endif
</div>
@endsection
