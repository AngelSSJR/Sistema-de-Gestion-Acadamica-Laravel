@extends('layouts.app')

@section('title', 'Detalle de Matrícula')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-file-earmark-text text-info me-2"></i>Detalle de Matrícula
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route($routePrefix . 'enrollments.edit', $enrollment) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route($routePrefix . 'enrollments.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person me-2"></i>Estudiante</h5>
                </div>
                <div class="card-body">
                    <h5>{{ $enrollment->student->user->name }}</h5>
                    <p class="text-muted mb-1"><strong>Código:</strong> {{ $enrollment->student->student_code }}</p>
                    <p class="text-muted mb-0"><strong>Email:</strong> {{ $enrollment->student->user->email }}</p>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información</h5>
                </div>
                <div class="card-body">
                    <dl class="mb-0">
                        <dt>Curso</dt>
                        <dd>{{ $enrollment->course->name }} ({{ $enrollment->course->code }})</dd>
                        <dt>Período</dt>
                        <dd>{{ $enrollment->academic_period }}</dd>
                        <dt>Fecha Matrícula</dt>
                        <dd>{{ $enrollment->enrollment_date?->format('d/m/Y') ?? '—' }}</dd>
                        <dt>Estado</dt>
                        <dd>
                            @php $map = ['active' => 'bg-success', 'completed' => 'bg-primary', 'withdrawn' => 'bg-danger']; @endphp
                            <span class="badge {{ $map[$enrollment->status] ?? 'bg-secondary' }}">{{ ucfirst($enrollment->status) }}</span>
                        </dd>
                        <dt>Registrado</dt>
                        <dd>{{ $enrollment->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-journal-bookmark-fill me-2"></i>Materias del Curso</h5>
                </div>
                <div class="card-body">
                    @if($enrollment->course->subjects->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($enrollment->course->subjects as $subject)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $subject->name }}
                                    <span class="badge bg-secondary">{{ $subject->code }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">El curso no tiene materias asignadas.</p>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Calificaciones</h5>
                </div>
                <div class="card-body">
                    @if($enrollment->grades->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr><th>Materia</th><th>Período</th><th>Nota</th></tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollment->grades as $grade)
                                        <tr>
                                            <td>{{ $grade->subject->name }}</td>
                                            <td>{{ $grade->period }}</td>
                                            <td><strong>{{ $grade->grade_value ?? '—' }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No hay calificaciones registradas aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
