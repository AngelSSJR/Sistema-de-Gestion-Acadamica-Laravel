@extends('layouts.app')

@section('title', 'Editar Matrícula')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square text-warning me-2"></i>Editar Matrícula
        </h2>
        <a href="{{ route($routePrefix . 'enrollments.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Estudiante: <strong>{{ $enrollment->student->user->name }}</strong> ({{ $enrollment->student->student_code }})
            </div>

            <form method="POST" action="{{ route($routePrefix . 'enrollments.update', $enrollment) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Curso *</label>
                        <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected(old('course_id', $enrollment->course_id) == $course->id)>
                                    {{ $course->name }} ({{ $course->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="academic_period" class="form-label">Período Académico *</label>
                        <input type="text" class="form-control @error('academic_period') is-invalid @enderror" id="academic_period" name="academic_period" value="{{ old('academic_period', $enrollment->academic_period) }}" required>
                        @error('academic_period') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="enrollment_date" class="form-label">Fecha de matrícula</label>
                        <input type="date" class="form-control @error('enrollment_date') is-invalid @enderror" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date', $enrollment->enrollment_date?->format('Y-m-d')) }}">
                        @error('enrollment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            @foreach(['active' => 'Activa', 'completed' => 'Completada', 'withdrawn' => 'Retirada'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $enrollment->status) == $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Actualizar
                    </button>
                    <a href="{{ route($routePrefix . 'enrollments.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
