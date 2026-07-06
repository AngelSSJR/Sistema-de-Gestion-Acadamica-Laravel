<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SGA') }} - @yield('title', 'Iniciar Sesión')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <i class="bi bi-mortarboard-fill display-4 text-primary"></i>
                    <h1 class="h4 mt-2">{{ config('app.name', 'SGA') }}</h1>
                    <p class="text-muted">Sistema de Gestión Académica</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        @yield('content')
                    </div>
                </div>

                <p class="text-center text-muted mt-3 small">
                    &copy; {{ date('Y') }} {{ config('app.name', 'SGA') }}. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
