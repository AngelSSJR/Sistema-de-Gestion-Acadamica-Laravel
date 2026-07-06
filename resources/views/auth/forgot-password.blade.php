@extends('layouts.guest')

@section('title', 'Recuperar Contraseña')

@section('content')
    <div class="mb-3 text-muted small">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecerla.') }}
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('login') }}" class="text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i>{{ __('Volver al inicio') }}
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send me-1"></i>{{ __('Enviar enlace') }}
            </button>
        </div>
    </form>
@endsection
