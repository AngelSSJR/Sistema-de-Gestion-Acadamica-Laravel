@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square text-warning me-2"></i>Editar Usuario
        </h2>
        <a href="{{ route('dev-admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('dev-admin.users.update', $user) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre completo *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Dejar vacío para mantener">
                        <small class="text-muted">Solo si desea cambiarla.</small>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="role" class="form-label">Rol *</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">Seleccionar...</option>
                            <option value="dev_admin" @selected(old('role', $user->roles->first()?->name) === 'dev_admin')>Desarrollador/Administrador</option>
                            <option value="secretary" @selected(old('role', $user->roles->first()?->name) === 'secretary')>Secretaría Académica</option>
                            <option value="coordinator" @selected(old('role', $user->roles->first()?->name) === 'coordinator')>Coordinador Académico</option>
                            <option value="teacher" @selected(old('role', $user->roles->first()?->name) === 'teacher')>Profesor</option>
                            <option value="student" @selected(old('role', $user->roles->first()?->name) === 'student')>Estudiante</option>
                            <option value="rector" @selected(old('role', $user->roles->first()?->name) === 'rector')>Rector/Dirección</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Actualizar
                    </button>
                    <a href="{{ route('dev-admin.users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
