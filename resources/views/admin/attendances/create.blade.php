@extends('layouts.app')

@section('title', 'Nueva Asistencia')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-plus-circle text-info me-2"></i>Nueva Asistencia
        </h2>
        <a href="{{ route('dev-admin.attendances.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('dev-admin.attendances.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="schedule_id" class="form-label">Horario *</label>
                        <select class="form-select @error('schedule_id') is-invalid @enderror" id="schedule_id" name="schedule_id" required>
                            <option value="">Seleccionar horario...</option>
                            @foreach($schedules as $schedule)
                                <option value="{{ $schedule->id }}" @selected(old('schedule_id') == $schedule->id)>
                                    {{ $schedule->course->name }} — {{ $schedule->subject->name }} — {{ $schedule->teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('schedule_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="student_id" class="form-label">Estudiante *</label>
                        <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                            <option value="">Seleccionar estudiante...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                                    {{ $student->user->name }} ({{ $student->student_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Fecha *</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Seleccionar estado...</option>
                            <option value="present" @selected(old('status') == 'present')>Presente</option>
                            <option value="absent" @selected(old('status') == 'absent')>Ausente</option>
                            <option value="late" @selected(old('status') == 'late')>Tardanza</option>
                            <option value="excused" @selected(old('status') == 'excused')>Justificado</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="remark" class="form-label">Observación</label>
                        <textarea class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark" rows="2">{{ old('remark') }}</textarea>
                        @error('remark') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-info text-white">
                        <i class="bi bi-check-lg me-1"></i>Guardar
                    </button>
                    <a href="{{ route('dev-admin.attendances.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
