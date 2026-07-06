@extends('layouts.guest')

@section('title', 'Registro')

@push('styles')
<style>
    .role-card {
        cursor: pointer;
        border: 2px solid #dee2e6;
        border-radius: 0.75rem;
        padding: 1rem;
        text-align: center;
        transition: all 0.2s ease;
    }
    .role-card:hover {
        border-color: #adb5bd;
        background-color: #f8f9fa;
    }
    .role-card.selected {
        border-color: #0d6efd;
        background-color: #e7f1ff;
    }
    .role-card i {
        font-size: 2rem;
        display: block;
        margin-bottom: 0.5rem;
    }
    .role-card input[type="radio"] {
        display: none;
    }
    .role-fields {
        display: none;
    }
    .role-fields.active {
        display: block;
    }
</style>
@endpush

@section('content')
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <div class="mb-4">
            <label class="form-label">{{ __('Tipo de usuario') }}</label>
            <div class="row g-2">
                <div class="col-6">
                    <label class="role-card w-100" id="card-teacher">
                        <input type="radio" name="role" value="teacher" {{ old('role') === 'teacher' ? 'checked' : '' }}>
                        <i class="bi bi-person-workspace"></i>
                        <strong>{{ __('Profesor') }}</strong>
                    </label>
                </div>
                <div class="col-6">
                    <label class="role-card w-100" id="card-student">
                        <input type="radio" name="role" value="student" {{ old('role') === 'student' ? 'checked' : '' }}>
                        <i class="bi bi-mortarboard"></i>
                        <strong>{{ __('Estudiante') }}</strong>
                    </label>
                </div>
            </div>
            @error('role')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre completo') }}</label>
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
            <input id="phone" type="text"
                   class="form-control @error('phone') is-invalid @enderror"
                   name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" type="password"
                   class="form-control"
                   name="password_confirmation" required autocomplete="new-password">
        </div>

        {{-- Campos específicos de Profesor --}}
        <div class="role-fields mt-3" id="teacher-fields">
            <hr>
            <p class="fw-semibold text-primary"><i class="bi bi-person-workspace me-1"></i>{{ __('Datos del Profesor') }}</p>
            <div class="mb-3">
                <label for="employee_code" class="form-label">{{ __('Código de empleado') }}</label>
                <input id="employee_code" type="text"
                       class="form-control @error('employee_code') is-invalid @enderror"
                       name="employee_code" value="{{ old('employee_code') }}">
                @error('employee_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="specialty" class="form-label">{{ __('Especialidad') }}</label>
                <input id="specialty" type="text"
                       class="form-control @error('specialty') is-invalid @enderror"
                       name="specialty" value="{{ old('specialty') }}">
                @error('specialty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="education_level" class="form-label">{{ __('Nivel educativo') }}</label>
                <select id="education_level" class="form-select @error('education_level') is-invalid @enderror" name="education_level">
                    <option value="">{{ __('Seleccionar...') }}</option>
                    <option value="Licenciatura" {{ old('education_level') === 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                    <option value="Maestría" {{ old('education_level') === 'Maestría' ? 'selected' : '' }}>Maestría</option>
                    <option value="Doctorado" {{ old('education_level') === 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                    <option value="Técnico" {{ old('education_level') === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                    <option value="Otro" {{ old('education_level') === 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('education_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Campos específicos de Estudiante --}}
        <div class="role-fields mt-3" id="student-fields">
            <hr>
            <p class="fw-semibold text-success"><i class="bi bi-mortarboard me-1"></i>{{ __('Datos del Estudiante') }}</p>
            <div class="mb-3">
                <label for="student_code" class="form-label">{{ __('Código de estudiante') }}</label>
                <input id="student_code" type="text"
                       class="form-control @error('student_code') is-invalid @enderror"
                       name="student_code" value="{{ old('student_code') }}">
                @error('student_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">{{ __('Edad') }}</label>
                <input id="age" type="number"
                       class="form-control @error('age') is-invalid @enderror"
                       name="age" value="{{ old('age') }}" min="0" max="80">
                @error('age')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-plus me-1"></i>{{ __('Registrarse') }}
            </button>
        </div>
    </form>

    <div class="text-center mt-3">
        <p class="small text-muted mb-0">{{ __('¿Ya tienes cuenta?') }}
            <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Iniciar Sesión') }}</a>
        </p>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.role-card');
        const teacherFields = document.getElementById('teacher-fields');
        const studentFields = document.getElementById('student-fields');
        const teacherInputs = teacherFields.querySelectorAll('input, select');
        const studentInputs = studentFields.querySelectorAll('input, select');

        function toggleRole(role) {
            cards.forEach(c => c.classList.remove('selected'));
            if (role === 'teacher') {
                document.getElementById('card-teacher').classList.add('selected');
                teacherFields.classList.add('active');
                studentFields.classList.remove('active');
                teacherInputs.forEach(el => el.removeAttribute('disabled'));
                studentInputs.forEach(el => el.setAttribute('disabled', 'disabled'));
            } else if (role === 'student') {
                document.getElementById('card-student').classList.add('selected');
                studentFields.classList.add('active');
                teacherFields.classList.remove('active');
                studentInputs.forEach(el => el.removeAttribute('disabled'));
                teacherInputs.forEach(el => el.setAttribute('disabled', 'disabled'));
            } else {
                teacherFields.classList.remove('active');
                studentFields.classList.remove('active');
                teacherInputs.forEach(el => el.setAttribute('disabled', 'disabled'));
                studentInputs.forEach(el => el.setAttribute('disabled', 'disabled'));
            }
        }

        cards.forEach(card => {
            card.addEventListener('click', function () {
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                toggleRole(radio.value);
            });
        });

        const selectedRadio = document.querySelector('input[name="role"]:checked');
        if (selectedRadio) {
            toggleRole(selectedRadio.value);
        }
    });
</script>
@endpush
