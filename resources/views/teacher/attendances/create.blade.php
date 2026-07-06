@extends('layouts.app')

@section('title', 'Tomar Asistencia')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-check-square text-info me-2"></i>
            Asistencia — {{ $schedule->subject->name }} — {{ $schedule->course->name }}
        </h2>
        <div>
            <span class="badge bg-secondary fs-6 me-2">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</span>
            <a href="{{ route('teacher.attendances.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('teacher.attendances.store') }}">
        @csrf
        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="card shadow-sm">
            <div class="card-body">
                @if($students->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Estudiante</th>
                                    <th style="width:100px">Código</th>
                                    <th class="text-center" style="width:120px">Estado</th>
                                    <th style="width:200px">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    @php
                                        $existing = $existingAttendances->get($student->id);
                                    @endphp
                                    <tr>
                                        <td>{{ $student->user->name }}</td>
                                        <td><span class="badge bg-secondary">{{ $student->student_code }}</span></td>
                                        <td>
                                            <input type="hidden" name="attendances[{{ $loop->index }}][student_id]" value="{{ $student->id }}">
                                            <select class="form-select form-select-sm" name="attendances[{{ $loop->index }}][status]" required>
                                                <option value="present" @selected($existing?->status === 'present')>Presente</option>
                                                <option value="absent" @selected($existing?->status === 'absent')>Ausente</option>
                                                <option value="late" @selected($existing?->status === 'late')>Tardanza</option>
                                                <option value="excused" @selected($existing?->status === 'excused')>Justificado</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                   name="attendances[{{ $loop->index }}][remark]"
                                                   value="{{ old('attendances.' . $loop->index . '.remark', $existing?->remark) }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-info text-white">
                            <i class="bi bi-save me-1"></i>Guardar Asistencia
                        </button>
                        <a href="{{ route('teacher.attendances.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox display-6 d-block mb-2"></i>
                        No hay estudiantes matriculados en este curso.
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
