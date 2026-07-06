@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i>Nuevo Usuario</h2>
            <a href="{{ route('dev-admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('dev-admin.users.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="role" class="form-label">Rol</label>
                            <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                                <option value="">Seleccionar...</option>
                                <option value="dev_admin" {{ old('role') === 'dev_admin' ? 'selected' : '' }}>Desarrollador/Administrador</option>
                                <option value="secretary" {{ old('role') === 'secretary' ? 'selected' : '' }}>Secretaría Académica</option>
                                <option value="coordinator" {{ old('role') === 'coordinator' ? 'selected' : '' }}>Coordinador Académico</option>
                                <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Profesor</option>
                                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Estudiante</option>
                                <option value="rector" {{ old('role') === 'rector' ? 'selected' : '' }}>Rector/Dirección</option>
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Campos de Profesor --}}
                    <div id="teacher-fields" class="row g-3 mt-3 d-none">
                        <div class="col-md-12">
                            <hr>
                            <p class="fw-semibold text-success"><i class="bi bi-person-badge me-1"></i>Datos del Profesor</p>
                        </div>
                        <div class="col-md-4">
                            <label for="employee_code" class="form-label">Código de empleado</label>
                            <input id="employee_code" type="text" class="form-control @error('employee_code') is-invalid @enderror"
                                   name="employee_code" value="{{ old('employee_code') }}">
                            @error('employee_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="specialty" class="form-label">Especialidad</label>
                            <input id="specialty" type="text" class="form-control @error('specialty') is-invalid @enderror"
                                   name="specialty" value="{{ old('specialty') }}">
                            @error('specialty') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="education_level" class="form-label">Nivel educativo</label>
                            <select id="education_level" class="form-select @error('education_level') is-invalid @enderror" name="education_level">
                                <option value="">Seleccionar...</option>
                                <option value="Licenciatura" {{ old('education_level') === 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                <option value="Maestría" {{ old('education_level') === 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                <option value="Doctorado" {{ old('education_level') === 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                <option value="Técnico" {{ old('education_level') === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                            </select>
                            @error('education_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Campos de Estudiante --}}
                    <div id="student-fields" class="row g-3 mt-3 d-none">
                        <div class="col-md-12">
                            <hr>
                            <p class="fw-semibold text-warning"><i class="bi bi-mortarboard me-1"></i>Datos del Estudiante</p>
                        </div>
                        <div class="col-md-4">
                            <label for="student_code" class="form-label">Código de estudiante</label>
                            <input id="student_code" type="text" class="form-control @error('student_code') is-invalid @enderror"
                                   name="student_code" value="{{ old('student_code') }}">
                            @error('student_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="age" class="form-label">Edad</label>
                            <input id="age" type="number" class="form-control @error('age') is-invalid @enderror"
                                   name="age" value="{{ old('age') }}" min="0" max="80">
                            @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark">
                            <i class="bi bi-check-lg me-1"></i>Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const teacherFields = document.getElementById('teacher-fields');
        const studentFields = document.getElementById('student-fields');

        function toggleFields() {
            const role = roleSelect.value;
            teacherFields.classList.toggle('d-none', role !== 'teacher');
            studentFields.classList.toggle('d-none', role !== 'student');
        }

        roleSelect.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>
@endpush
