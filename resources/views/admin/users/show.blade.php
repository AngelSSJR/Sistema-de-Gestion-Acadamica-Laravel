@extends('layouts.app')

@section('title', 'Detalle del Usuario')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-person-circle text-info me-2"></i>{{ $user->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dev-admin.users.edit', $user) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route('dev-admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="bi bi-person-circle display-1 text-secondary mb-3"></i>
                    <h5>{{ $user->name }}</h5>
                    @php
                        $role = $user->roles->first();
                        $badge = match ($role?->name) {
                            'dev_admin' => 'bg-dark',
                            'secretary' => 'bg-primary',
                            'coordinator' => 'bg-info',
                            'teacher' => 'bg-success',
                            'student' => 'bg-warning text-dark',
                            'rector' => 'bg-danger',
                            default => 'bg-secondary',
                        };
                    @endphp
                    @if ($role)
                        <span class="badge {{ $badge }} mb-2">{{ $role->name }}</span>
                    @endif
                    <p class="text-muted small mb-0">{{ $user->getRoleDisplayName() }}</p>
                </div>
            </div>

            @if ($user->teacher || $user->student)
                <div class="card shadow-sm mt-4">
                    <div class="card-body text-center p-4">
                        @if ($user->teacher)
                            <i class="bi bi-person-badge display-6 text-success mb-2"></i>
                            <h6>Datos de Profesor</h6>
                            <p class="mb-1"><strong>Código:</strong> {{ $user->teacher->employee_code }}</p>
                            <p class="mb-1"><strong>Especialidad:</strong> {{ $user->teacher->specialty ?? '—' }}</p>
                            <p class="mb-0"><strong>Nivel:</strong> {{ $user->teacher->education_level ?? '—' }}</p>
                        @endif
                        @if ($user->student)
                            <i class="bi bi-mortarboard display-6 text-warning mb-2"></i>
                            <h6>Datos de Estudiante</h6>
                            <p class="mb-1"><strong>Código:</strong> {{ $user->student->student_code }}</p>
                            <p class="mb-0"><strong>Edad:</strong> {{ $user->student->age ?? '—' }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $user->email }}</dd>
                        <dt class="col-sm-4">Teléfono</dt>
                        <dd class="col-sm-8">{{ $user->phone ?? '—' }}</dd>
                        <dt class="col-sm-4">Rol</dt>
                        <dd class="col-sm-8">{{ $user->getRoleDisplayName() }}</dd>
                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </dd>
                        <dt class="col-sm-4">Email verificado</dt>
                        <dd class="col-sm-8">
                            @if ($user->email_verified_at)
                                <span class="badge bg-success">Sí</span>
                                <small class="text-muted ms-1">{{ $user->email_verified_at->format('d/m/Y H:i') }}</small>
                            @else
                                <span class="badge bg-warning text-dark">No</span>
                            @endif
                        </dd>
                        <dt class="col-sm-4">Registrado</dt>
                        <dd class="col-sm-8">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                        <dt class="col-sm-4">Última actualización</dt>
                        <dd class="col-sm-8">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
