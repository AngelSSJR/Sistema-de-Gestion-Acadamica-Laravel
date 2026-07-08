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
        .card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
        }
        .text-muted {
            --bs-text-opacity: 0.85;
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

                <div class="card shadow-sm border-0">
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
