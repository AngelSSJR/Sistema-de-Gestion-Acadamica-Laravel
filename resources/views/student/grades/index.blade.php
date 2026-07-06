@extends('layouts.app')

@section('title', 'Mis Notas')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-bar-chart text-success me-2"></i>Boletín de Notas
        </h2>
    </div>

    @if($enrollments->count() > 0)
        @foreach($enrollments as $enrollment)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-diagram-3 me-2"></i>{{ $enrollment->course->name }}
                        <span class="badge bg-secondary">{{ $enrollment->academic_period }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($enrollment->course->subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Materia</th>
                                        @for($p = 1; $p <= 6; $p++)
                                            <th class="text-center">P{{ $p }}</th>
                                        @endfor
                                        <th class="text-center">Promedio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollment->course->subjects as $subject)
                                        @php
                                            $subjectGrades = $enrollment->grades->where('subject_id', $subject->id);
                                            $avg = $subjectGrades->whereNotNull('grade_value')->avg('grade_value');
                                        @endphp
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            @for($p = 1; $p <= 6; $p++)
                                                @php
                                                    $grade = $subjectGrades->where('period', $p)->first();
                                                @endphp
                                                <td class="text-center">
                                                    @if($grade && $grade->grade_value)
                                                        <span class="{{ $grade->grade_value < 11 ? 'text-danger' : 'text-success' }} fw-bold">
                                                            {{ number_format($grade->grade_value, 1) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                            @endfor
                                            <td class="text-center">
                                                @if($avg)
                                                    <span class="{{ $avg < 11 ? 'text-danger' : 'text-success' }} fw-bold">
                                                        {{ number_format($avg, 1) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">El curso no tiene materias asignadas.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center text-muted py-5">
                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                <h5>No estás matriculado en ningún curso activo.</h5>
                <p>Para ver tus notas, debes estar matriculado en un curso.</p>
            </div>
        </div>
    @endif
</div>
@endsection
