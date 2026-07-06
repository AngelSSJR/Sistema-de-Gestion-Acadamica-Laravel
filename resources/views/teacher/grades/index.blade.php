@extends('layouts.app')

@section('title', 'Calificaciones')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-bar-chart text-warning me-2"></i>Calificaciones
        </h2>
    </div>

    @if($subjects->count() > 0)
        <div class="row g-4">
            @foreach($subjects as $subject)
                @php
                    $courseList = $schedules->get($subject->id)?->pluck('course.name')->unique()->implode(', ');
                @endphp
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">{{ $subject->name }} <span class="badge bg-secondary">{{ $subject->code }}</span></h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">
                                <i class="bi bi-diagram-3 me-1"></i>Cursos: {{ $courseList ?? 'Sin cursos asignados' }}
                            </p>
                            <div class="d-flex gap-2 flex-wrap">
                                @for($i = 1; $i <= 6; $i++)
                                    <a href="{{ route('teacher.grades.create', ['subject_id' => $subject->id, 'period' => $i]) }}"
                                       class="btn btn-outline-warning btn-sm">
                                        Período {{ $i }}
                                    </a>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center text-muted py-4">
                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                No tienes materias asignadas.
            </div>
        </div>
    @endif
</div>
@endsection
