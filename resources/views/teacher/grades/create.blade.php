@extends('layouts.app')

@section('title', 'Registrar Calificaciones')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-bar-chart text-warning me-2"></i>
            {{ $subject->name }} — Período {{ $period }}
        </h2>
        <a href="{{ route('teacher.grades.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <form method="POST" action="{{ route('teacher.grades.store') }}">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
        <input type="hidden" name="period" value="{{ $period }}">
        <input type="hidden" name="academic_period" value="{{ date('Y') . '-' . (date('Y') + 1) }}">

        <div class="card shadow-sm">
            <div class="card-body">
                @if($students->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Curso</th>
                                    <th style="width:120px">Nota (0-100)</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    @php
                                        $enrollment = $student->enrollments->whereIn('course_id', $courses->pluck('id'))->where('status', 'active')->first();
                                        $existingGrade = $enrollment && $existingGrades->has($enrollment->id) ? $existingGrades[$enrollment->id] : null;
                                    @endphp
                                    @if($enrollment)
                                        <tr>
                                            <td>
                                                {{ $student->user->name }}
                                                <br><small class="text-muted">{{ $student->student_code }}</small>
                                            </td>
                                            <td>{{ $enrollment->course->name }}</td>
                                            <td>
                                                <input type="hidden" name="grades[{{ $loop->index }}][enrollment_id]" value="{{ $enrollment->id }}">
                                                <input type="number" step="0.01" class="form-control form-control-sm" min="0" max="100"
                                                       name="grades[{{ $loop->index }}][grade_value]"
                                                       value="{{ old('grades.' . $loop->index . '.grade_value', $existingGrade?->grade_value) }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm"
                                                       name="grades[{{ $loop->index }}][comment]"
                                                       value="{{ old('grades.' . $loop->index . '.comment', $existingGrade?->comment) }}">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Guardar Calificaciones
                        </button>
                        <a href="{{ route('teacher.grades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox display-6 d-block mb-2"></i>
                        No hay estudiantes matriculados en este período.
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
