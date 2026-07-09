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
                                    <a class="nav-link" href="{{ route('universidad') }}">
                                        <i class="bi bi-building me-1"></i>La Universidad
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>Ingresar
                                    </a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row justify-content-center text-center py-5" style="animation: fadeInUp 0.7s ease backwards;">
                <div class="col-lg-8">
                    <img src="{{ asset('img/ChatGPT Image 7 jul 2026, 22_08_36.png') }}" alt="UF" height="90" class="mb-3" style="animation: fadeIn 0.8s ease backwards;">
                    <h1 class="display-4 fw-bold mb-3 text-white" style="animation: fadeInUp 0.6s ease backwards 0.1s;">Universidad de Fundación</h1>
                    <p class="lead text-white-50 mb-4" style="animation: fadeInUp 0.6s ease backwards 0.2s;">Sistema de Gestión Académica</p>
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
                        @endauth
                    @endif
                </div>
            </div>

            <div class="row g-4 py-5">
                <div class="col-md-4" style="animation: fadeInUp 0.5s ease backwards 0.2s;">
                    <div class="card border-0 shadow-sm h-100 welcome-card" style="background:transparent;border:1px solid rgba(255,255,255,0.15)!important;">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-people display-5 mb-3" style="color:#86b7fe"></i>
                            <h5 style="color:#fff">Gestión de Usuarios</h5>
                            <p class="small" style="color:rgba(255,255,255,0.75)">Administra estudiantes, profesores y personal administrativo con roles y permisos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="animation: fadeInUp 0.5s ease backwards 0.4s;">
                    <div class="card border-0 shadow-sm h-100 welcome-card" style="background:transparent;border:1px solid rgba(255,255,255,0.15)!important;">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-journal-bookmark-fill display-5 mb-3" style="color:#86b7fe"></i>
                            <h5 style="color:#fff">Control Académico</h5>
                            <p class="small" style="color:rgba(255,255,255,0.75)">Gestiona materias, horarios, calificaciones y asistencia en tiempo real.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="animation: fadeInUp 0.5s ease backwards 0.6s;">
                    <div class="card border-0 shadow-sm h-100 welcome-card" style="background:transparent;border:1px solid rgba(255,255,255,0.15)!important;">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-bar-chart display-5 mb-3" style="color:#86b7fe"></i>
                            <h5 style="color:#fff">Reportes</h5>
                            <p class="small" style="color:rgba(255,255,255,0.75)">Visualiza boletines de notas, estadísticas y reportes académicos.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center py-5" style="animation: fadeInUp 0.6s ease backwards 0.8s;">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm welcome-card" style="background:transparent;border:1px solid rgba(255,255,255,0.15)!important;">
                        <div class="card-body p-5" style="color:#fff">
                            <h3 class="text-center fw-bold mb-4" style="color:#fff">DATOS DE CONTACTO</h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-telephone-fill fs-4 me-3" style="color:#86b7fe"></i>
                                        <div>
                                            <strong>PBX:</strong> +57 312 2916169
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-telephone-fill fs-4 me-3" style="color:#86b7fe"></i>
                                        <div>
                                            <strong>Contact Center Admisiones:</strong><br>
                                            +57 317 0985438 — +57 320 5370471<br>
                                            +57 320 6545162
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-geo-alt-fill fs-4 me-3" style="color:#86b7fe"></i>
                                        <div>
                                            <strong>Canales físicos de atención</strong><br>
                                            - Sede sur: Calle 3 #3208 San Carlos<br>
                                            - Sede centro: Calle 9 N° 9-126, Fundación, Colombia, 472020<br>
                                            - Sede Norte: Carrera 8 No 18 - 82, Magdalena, Fundación
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-envelope-fill fs-4 me-3" style="color:#86b7fe"></i>
                                        <div>
                                            <strong>Notificaciones Judiciales:</strong><br>
                                            <a href="mailto:notificaciones@mail.unifundacion.edu.co" class="text-decoration-none" style="color:#86b7fe">notificaciones@mail.unifundacion.edu.co</a>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-envelope-fill fs-4 me-3" style="color:#86b7fe"></i>
                                        <div>
                                            <strong>Correo Admisiones:</strong><br>
                                            <a href="mailto:comunicacionesadmisiones@mail.uniatlantico.edu.co" class="text-decoration-none" style="color:#86b7fe">comunicacionesadmisiones@mail.uniatlantico.edu.co</a>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('universidad') }}" class="btn btn-primary px-4">
                                            <i class="bi bi-info-circle me-1"></i>Más Información
                                        </a>
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
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
