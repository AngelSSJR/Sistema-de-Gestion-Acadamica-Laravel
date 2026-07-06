@extends('layouts.app')

@section('title', 'Editar Asistencia')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square text-warning me-2"></i>Editar Asistencia
        </h2>
        <a href="{{ route('dev-admin.attendances.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>{{ $attendance->student->user->name }}</strong> —
                {{ $attendance->schedule->subject->name }} —
                {{ $attendance->date->format('d/m/Y') }}
            </div>

            <form method="POST" action="{{ route('dev-admin.attendances.update', $attendance) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="present" @selected(old('status', $attendance->status) == 'present')>Presente</option>
                            <option value="absent" @selected(old('status', $attendance->status) == 'absent')>Ausente</option>
                            <option value="late" @selected(old('status', $attendance->status) == 'late')>Tardanza</option>
                            <option value="excused" @selected(old('status', $attendance->status) == 'excused')>Justificado</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="remark" class="form-label">Observación</label>
                        <textarea class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark" rows="2">{{ old('remark', $attendance->remark) }}</textarea>
                        @error('remark') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Actualizar
                    </button>
                    <a href="{{ route('dev-admin.attendances.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
