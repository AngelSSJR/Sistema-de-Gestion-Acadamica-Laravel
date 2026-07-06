@extends('layouts.app')

@section('title', 'Detalle de Asistencia')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-check-square text-info me-2"></i>Detalle de Asistencia
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dev-admin.attendances.edit', $attendance) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route('dev-admin.attendances.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person me-2"></i>Estudiante</h5>
                </div>
                <div class="card-body">
                    <h5>{{ $attendance->student->user->name }}</h5>
                    <p class="text-muted mb-0"><strong>Código:</strong> {{ $attendance->student->student_code }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Asistencia</h5>
                </div>
                <div class="card-body">
                    <dl class="mb-0">
                        <dt>Curso</dt>
                        <dd>{{ $attendance->schedule->course->name }}</dd>
                        <dt>Materia</dt>
                        <dd>{{ $attendance->schedule->subject->name }}</dd>
                        <dt>Profesor</dt>
                        <dd>{{ $attendance->schedule->teacher->user->name }}</dd>
                        <dt>Horario</dt>
                        <dd>{{ \Carbon\Carbon::parse($attendance->schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($attendance->schedule->end_time)->format('H:i') }}</dd>
                        <dt>Fecha</dt>
                        <dd>{{ $attendance->date->format('d/m/Y') }}</dd>
                        <dt>Estado</dt>
                        <dd>
                            @php $map = ['present' => 'bg-success', 'absent' => 'bg-danger', 'late' => 'bg-warning text-dark', 'excused' => 'bg-secondary']; @endphp
                            <span class="badge {{ $map[$attendance->status] ?? 'bg-secondary' }}">{{ __(ucfirst($attendance->status)) }}</span>
                        </dd>
                        <dt>Observación</dt>
                        <dd>{{ $attendance->remark ?? '—' }}</dd>
                        <dt>Registrado por</dt>
                        <dd>{{ $attendance->registrar->name }}</dd>
                        <dt>Registrado el</dt>
                        <dd>{{ $attendance->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
