@extends('layouts.app')

@section('title', 'Nueva Calificación')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-plus-circle text-success me-2"></i>Nueva Calificación
        </h2>
        <a href="{{ route('dev-admin.grades.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('dev-admin.grades.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="enrollment_id" class="form-label">Matrícula (Estudiante - Curso) *</label>
                        <select class="form-select @error('enrollment_id') is-invalid @enderror" id="enrollment_id" name="enrollment_id" required>
                            <option value="">Seleccionar matrícula...</option>
                            @foreach($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}" @selected(old('enrollment_id') == $enrollment->id)>
                                    {{ $enrollment->student->user->name }} — {{ $enrollment->course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="subject_id" class="form-label">Materia *</label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                            <option value="">Seleccionar materia...</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>
                                    {{ $subject->name }} ({{ $subject->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="teacher_id" class="form-label">Profesor *</label>
                        <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" required>
                            <option value="">Seleccionar profesor...</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>
                                    {{ $teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="period" class="form-label">Período *</label>
                        <select class="form-select @error('period') is-invalid @enderror" id="period" name="period" required>
                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" @selected(old('period') == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('period') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="grade_value" class="form-label">Nota (0-100)</label>
                        <input type="number" step="0.01" class="form-control @error('grade_value') is-invalid @enderror" id="grade_value" name="grade_value" value="{{ old('grade_value') }}" min="0" max="100">
                        @error('grade_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="academic_period" class="form-label">Período Académico</label>
                        <input type="text" class="form-control @error('academic_period') is-invalid @enderror" id="academic_period" name="academic_period" value="{{ old('academic_period', date('Y') . '-' . (date('Y')+1)) }}">
                        @error('academic_period') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="comment" class="form-label">Comentario</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="2">{{ old('comment') }}</textarea>
                        @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg me-1"></i>Guardar
                    </button>
                    <a href="{{ route('dev-admin.grades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
