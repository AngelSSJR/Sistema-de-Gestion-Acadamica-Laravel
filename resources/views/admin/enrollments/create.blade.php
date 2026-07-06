@extends('layouts.app')

@section('title', 'Nueva Matrícula')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-file-earmark-plus text-primary me-2"></i>Nueva Matrícula
        </h2>
        <a href="{{ route($routePrefix . 'enrollments.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route($routePrefix . 'enrollments.store') }}">
                @csrf

                <div class="row g-3">
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
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Curso *</label>
                        <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                            <option value="">Seleccionar curso...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                    {{ $course->name }} ({{ $course->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="academic_period" class="form-label">Período Académico *</label>
                        <input type="text" class="form-control @error('academic_period') is-invalid @enderror" id="academic_period" name="academic_period" value="{{ old('academic_period', date('Y') . '-' . (date('Y')+1)) }}" required>
                        @error('academic_period') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="enrollment_date" class="form-label">Fecha de matrícula</label>
                        <input type="date" class="form-control @error('enrollment_date') is-invalid @enderror" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date', date('Y-m-d')) }}">
                        @error('enrollment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" @selected(old('status', 'active') == 'active')>Activa</option>
                            <option value="completed" @selected(old('status') == 'completed')>Completada</option>
                            <option value="withdrawn" @selected(old('status') == 'withdrawn')>Retirada</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>Matricular
                    </button>
                    <a href="{{ route($routePrefix . 'enrollments.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
