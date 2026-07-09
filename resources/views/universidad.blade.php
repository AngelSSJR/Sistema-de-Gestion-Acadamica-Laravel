<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UF - La Universidad</title>
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
        .card-translucent {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.15) !important;
        }
        .card-translucent,
        .card-translucent p,
        .card-translucent strong:not(.text-primary) {
            color: #fff !important;
        }
        .card-translucent a:not(.btn) {
            color: #86b7fe !important;
        }
        .card-translucent .text-primary {
            color: #86b7fe !important;
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
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('universidad') }}">
                                <i class="bi bi-building me-1"></i>La Universidad
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Ingresar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="text-center mb-5">
                        <img src="{{ asset('img/ChatGPT Image 7 jul 2026, 22_08_36.png') }}" alt="UF" height="100" class="mb-3">
                        <h1 class="display-4 fw-bold text-white">La Universidad</h1>
                    </div>

                    <div class="card card-translucent border-0 shadow-sm mb-5 welcome-card" style="animation: fadeInUp 0.6s ease backwards 0.2s;">
                        <div class="card-body p-5">
                            <h3 class="fw-bold mb-3">SOBRE NOSOTROS</h3>
                            <p class="fs-5 fst-italic text-primary mb-4">¡La mejor educación al alcance de todos!</p>
                            <p>
                                La Universidad de Fundación está localizada en el municipio de Fundación, capital del Departamento del Magdalena. Fue gestada por el filósofo Angel David Romo, quien en su empeño por la educación pública como requisito de mayoría de edad del pueblo costeño, diseñó y puso en marcha este claustro de educación superior. Un proceso que se inició en 1.941 y que se vio definitivamente cristalizado en el año de 1.946.
                            </p>
                            <p>
                                Es indudable que el origen de la Universidad de Fundación está directamente relacionado con su principal gestor, el filósofo visionario, Fundanense, Angel David Romo. A su concepción sobre la importancia que la educación tiene en la transformación positiva de los pueblos y de las sociedades, se deben las principales iniciativas pedagógicas que culminaron con la creación de la Universidad de Fundación.
                            </p>
                        </div>
                    </div>

                    <div class="card card-translucent border-0 shadow-sm mb-4 welcome-card" style="animation: fadeInUp 0.6s ease backwards 0.4s;">
                        <div class="card-body p-5">
                            <h3 class="text-center fw-bold mb-4">DATOS DE CONTACTO</h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-telephone-fill fs-4 text-primary me-3"></i>
                                        <div>
                                            <strong>PBX:</strong> +57 312 2916169
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-telephone-fill fs-4 text-primary me-3"></i>
                                        <div>
                                            <strong>Contact Center Admisiones:</strong><br>
                                            +57 317 0985438 — +57 320 5370471<br>
                                            +57 320 6545162
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-geo-alt-fill fs-4 text-primary me-3"></i>
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
                                        <i class="bi bi-envelope-fill fs-4 text-primary me-3"></i>
                                        <div>
                                            <strong>Notificaciones Judiciales:</strong><br>
                                            <a href="mailto:notificaciones@mail.unifundacion.edu.co" class="text-decoration-none">notificaciones@mail.unifundacion.edu.co</a>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-envelope-fill fs-4 text-primary me-3"></i>
                                        <div>
                                            <strong>Correo Admisiones:</strong><br>
                                            <a href="mailto:comunicacionesadmisiones@mail.uniatlantico.edu.co" class="text-decoration-none">comunicacionesadmisiones@mail.uniatlantico.edu.co</a>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <a href="{{ route('home') }}" class="btn btn-primary px-4">
                                            <i class="bi bi-house-door me-1"></i>Inicio
                                        </a>
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