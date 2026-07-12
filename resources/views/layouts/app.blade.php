<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UF - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: url('{{ asset('img/fondo-negro-y-azul-vke2q5mo8108tqdh.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }
        .wrapper {
            position: relative;
            z-index: 1;
        }
        .main-content .navbar {
            background: rgba(0, 0, 0, 0.75) !important;
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .main-content .navbar .nav-link,
        .main-content .navbar .dropdown-toggle {
            color: rgba(255,255,255,0.85) !important;
        }
        .main-content .navbar .badge {
            color: #fff !important;
        }
        .main-content .navbar .dropdown-menu {
            background: rgba(20, 25, 40, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .main-content .navbar .dropdown-menu .dropdown-item {
            color: rgba(255,255,255,0.8);
        }
        .main-content .navbar .dropdown-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .main-content .navbar .dropdown-divider {
            border-color: rgba(255,255,255,0.1);
        }
        .card { color: #fff; }
        .card .table {
            color: #fff;
        }
        .card .table thead.table-light th,
        .card .table thead th {
            color: rgba(255,255,255,0.8) !important;
            border-color: rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.08) !important;
        }
        .card .table tbody td,
        .card .table-bordered tbody td,
        .card .table-bordered thead th {
            border-color: rgba(255,255,255,0.08);
            background: transparent !important;
        }
        .card .table tbody tr {
            background: #0e0e10 !important;
        }
        .card .table tbody tr td {
            color: #fff;
        }
        .card .table tbody tr:hover {
            background: rgba(255,255,255,0.08) !important;
        }
        .card .table-striped tbody tr:nth-of-type(odd) {
            background: #151515 !important;
        }
        .card .table tbody tr.table-active,
        .card .table tbody tr.active {
            background: rgba(255,255,255,0.1) !important;
        }
        .card .table tbody tr.table-active td,
        .card .table tbody tr.active td {
            color: #fff;
        }
        .card .text-muted {
            color: rgba(255,255,255,0.6) !important;
        }
        .card .list-group-item {
            background: transparent !important;
            color: #fff;
            border-color: rgba(255,255,255,0.08);
        }
        .page-link {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.8);
        }
        .page-link:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.25);
            color: #fff;
        }
        .page-item.active .page-link {
            background: #0d6efd;
            border-color: #0d6efd;
        }
        .page-item.disabled .page-link {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.3);
        }
        .table .badge {
            color: #fff !important;
        }
        h2, h5, h6, label, th, td, p, strong {
            color: #fff;
        }
        .form-label {
            color: #fff !important;
        }
        .alert {
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(6px);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .alert-success { border-left-color: #198754; }
        .alert-danger { border-left-color: #dc3545; }
        .btn-close {
            filter: invert(1);
        }
        .main-content footer {
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @include('layouts.partials.sidebar')

        <div class="main-content">
            <nav class="navbar navbar-expand-lg navbar-dark shadow-sm px-4">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                   role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle fs-5 me-2"></i>
                                    {{ auth()->user()->name }}
                                    <span class="badge bg-info ms-2">{{ auth()->user()->getRoleDisplayName() }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="bi bi-person me-2"></i>{{ __('Perfil') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-left me-2"></i>{{ __('Cerrar Sesión') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="p-4 pb-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="text-white text-center py-3 small border-top border-white border-opacity-10">
                <p class="mb-0">&copy; {{ date('Y') }} Universidad de Fundación. Todos los derechos reservados.</p>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
