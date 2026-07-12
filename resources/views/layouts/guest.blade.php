<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UF - @yield('title', 'Iniciar Sesión')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body {
            background: url('{{ asset('img/OIG2.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }
        .container {
            position: relative;
            z-index: 1;
        }
        .card.login-card {
            background: transparent;
            backdrop-filter: none;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        .card.login-card::before,
        .card.login-card::after {
            display: none !important;
        }
        .text-muted {
            --bs-text-opacity: 0.85;
        }
        .login-card .form-label {
            color: #fff;
        }
        .login-card .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .login-card .form-control:focus {
            background: #fff;
        }
        .login-card .form-check-label {
            color: rgba(255, 255, 255, 0.85);
        }
        .login-card a:not(.btn) {
            color: #86b7fe;
        }
        .login-card a:not(.btn):hover {
            color: #a8d0ff;
        }

        .btn-neon {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            border: none;
            background: #0d6efd;
            z-index: 1;
            transition: all 0.3s ease;
        }
        .btn-neon::before {
            content: '';
            position: absolute;
            inset: -3px;
            z-index: -2;
            background: conic-gradient(
                #0d6efd, #4d9aff, #00d4ff, #7b2ff7, #ff0080, #0d6efd
            );
            animation: electric-border 2s linear infinite;
            border-radius: inherit;
        }
        .btn-neon::after {
            content: '';
            position: absolute;
            inset: 2px;
            z-index: -1;
            background: #0d6efd;
            border-radius: inherit;
            transition: background 0.3s ease;
        }
        .btn-neon:hover {
            transform: translateY(-2px);
        }
        .btn-neon:hover::after {
            background: #0a58ca;
        }
        @keyframes electric-border {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('img/ChatGPT Image 7 jul 2026, 22_08_36.png') }}" alt="UF" height="80">
                    <h1 class="h4 mt-2 text-white">Universidad de Fundación</h1>
                    <p class="text-white-50">Sistema de Gestión Académica</p>
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

                <div class="card shadow-sm border-0 login-card">
                    <div class="card-body p-4">
                        @yield('content')
                    </div>
                </div>

                <p class="text-center text-white-50 mt-3 small">
                    &copy; {{ date('Y') }} Universidad de Fundación. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
