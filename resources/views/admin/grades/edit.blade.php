@extends('layouts.app')

@section('title', 'Editar Calificación')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square text-warning me-2"></i>Editar Calificación
        </h2>
        <a href="{{ route('dev-admin.grades.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>{{ $grade->enrollment->student->user->name }}</strong> —
                {{ $grade->subject->name }} — Período {{ $grade->period }}
            </div>

            <form method="POST" action="{{ route('dev-admin.grades.update', $grade) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="grade_value" class="form-label">Nota (0-100)</label>
                        <input type="number" step="0.01" class="form-control @error('grade_value') is-invalid @enderror" id="grade_value" name="grade_value" value="{{ old('grade_value', $grade->grade_value) }}" min="0" max="100">
                        @error('grade_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="comment" class="form-label">Comentario</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="2">{{ old('comment', $grade->comment) }}</textarea>
                        @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Actualizar
                    </button>
                    <a href="{{ route('dev-admin.grades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
