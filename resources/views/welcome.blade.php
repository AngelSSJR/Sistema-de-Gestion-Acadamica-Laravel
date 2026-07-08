<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Universidad de Fundación UF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: url('{{ asset('img/OIG2.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.75) !important;
            backdrop-filter: blur(6px);
        }
        .card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
        }
        footer {
            background: rgba(0, 0, 0, 0.75) !important;
            backdrop-filter: blur(6px);
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    Universidad de Fundación
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/dashboard') }}">
                                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>Ingresar
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">
                                            <i class="bi bi-person-plus me-1"></i>Registro
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row justify-content-center text-center py-5">
                <div class="col-lg-8">
                    <img src="{{ asset('img/ChatGPT Image 7 jul 2026, 22_08_36.png') }}" alt="UF" height="90" class="mb-3">
                    <h1 class="display-4 fw-bold mb-3 text-white">Universidad de Fundación</h1>
                    <p class="lead text-white-50 mb-4">Sistema de Gestión Académica</p>
                    <p class="text-white-50 mb-4">Plataforma integral para la administración de instituciones educativas. Gestión de estudiantes, profesores, materias, horarios, calificaciones y asistencia.</p>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-speedometer2 me-2"></i>Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 me-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5">
                                    <i class="bi bi-person-plus me-2"></i>Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="row g-4 py-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-people display-5 text-primary mb-3"></i>
                            <h5>Gestión de Usuarios</h5>
                            <p class="text-muted small">Administra estudiantes, profesores y personal administrativo con roles y permisos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-journal-bookmark-fill display-5 text-success mb-3"></i>
                            <h5>Control Académico</h5>
                            <p class="text-muted small">Gestiona materias, horarios, calificaciones y asistencia en tiempo real.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-bar-chart display-5 text-warning mb-3"></i>
                            <h5>Reportes</h5>
                            <p class="text-muted small">Visualiza boletines de notas, estadísticas y reportes académicos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-white text-center py-3 mt-5">
            <p class="mb-0 small">&copy; {{ date('Y') }} Universidad de Fundación. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>
