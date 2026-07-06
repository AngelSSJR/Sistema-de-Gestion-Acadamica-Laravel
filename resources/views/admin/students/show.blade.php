@extends('layouts.app')

@section('title', 'Detalle del Estudiante')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-person-vcard text-info me-2"></i>{{ $student->user->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route($routePrefix . 'students.edit', $student) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route($routePrefix . 'students.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="bi bi-mortarboard display-1 text-secondary mb-3"></i>
                    <h5>{{ $student->user->name }}</h5>
                    <span class="badge bg-success mb-2">{{ $student->student_code }}</span>
                    @php
                        $statusClasses = ['active' => 'bg-success', 'graduated' => 'bg-primary', 'suspended' => 'bg-warning text-dark', 'withdrawn' => 'bg-danger'];
                    @endphp
                    <span class="badge {{ $statusClasses[$student->status] ?? 'bg-secondary' }} d-block mt-1">
                        {{ ucfirst($student->status) }}
                    </span>
                    @if($student->age)<span class="badge bg-info mt-1">{{ $student->age }} años</span>@endif
                    <p class="text-muted small mt-2 mb-0">Ingreso: {{ $student->enrollment_date?->format('d/m/Y') ?? '—' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $student->user->email }}</dd>
                        <dt class="col-sm-4">Teléfono</dt>
                        <dd class="col-sm-8">{{ $student->user->phone ?? '—' }}</dd>
                        <dt class="col-sm-4">Edad</dt>
                        <dd class="col-sm-8">{{ $student->age ?? '—' }}</dd>
                        <dt class="col-sm-4">Código Estudiante</dt>
                        <dd class="col-sm-8">{{ $student->student_code }}</dd>
                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">{{ ucfirst($student->status) }}</dd>
                        <dt class="col-sm-4">Fecha Ingreso</dt>
                        <dd class="col-sm-8">{{ $student->enrollment_date?->format('d/m/Y') ?? '—' }}</dd>
                        <dt class="col-sm-4">Registrado</dt>
                        <dd class="col-sm-8">{{ $student->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Matrículas</h5>
                </div>
                <div class="card-body">
                    @if($student->enrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Curso</th>
                                        <th>Período</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->course->name }}</td>
                                            <td>{{ $enrollment->academic_period }}</td>
                                            <td>
                                                <span class="badge {{ $enrollment->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">Este estudiante no tiene matrículas activas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
