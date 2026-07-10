<nav class="sidebar d-flex flex-column">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none d-flex align-items-center gap-2 w-100">
            <img src="{{ asset('img/ChatGPT Image 7 jul 2026, 22_08_36.png') }}" alt="UF" height="36">
            <span class="brand-text fw-semibold fs-6">Universidad UF</span>
        </a>
    </div>

    <div class="sidebar-section">
        <small>{{ __('Menú Principal') }}</small>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}"
               href="{{ route(auth()->user()->getDashboardRoute()) }}">
                <i class="bi bi-speedometer2"></i>
                <span class="nav-text">{{ __('Dashboard') }}</span>
            </a>
        </li>

        {{-- Desarrollador/Administrador --}}
        @role('dev_admin')
            <li class="nav-item mt-2">
                <div class="sidebar-section">
                    <small>{{ __('Sistema') }}</small>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.users.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.users.index') }}">
                    <i class="bi bi-people-fill"></i>
                    <span class="nav-text">{{ __('Usuarios') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.teachers.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.teachers.index') }}">
                    <i class="bi bi-person-badge"></i>
                    <span class="nav-text">{{ __('Profesores') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.students.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.students.index') }}">
                    <i class="bi bi-mortarboard"></i>
                    <span class="nav-text">{{ __('Estudiantes') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.courses.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.courses.index') }}">
                    <i class="bi bi-diagram-3"></i>
                    <span class="nav-text">{{ __('Cursos') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.subjects.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.subjects.index') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span class="nav-text">{{ __('Materias') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.enrollments.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.enrollments.index') }}">
                    <i class="bi bi-file-earmark-plus"></i>
                    <span class="nav-text">{{ __('Matrículas') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.rooms.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.rooms.index') }}">
                    <i class="bi bi-building"></i>
                    <span class="nav-text">{{ __('Ambientes') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.schedules.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    <span class="nav-text">{{ __('Horarios') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.course-subjects.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.course-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    <span class="nav-text">{{ __('Materias x Curso') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.teacher-subjects.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.teacher-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    <span class="nav-text">{{ __('Materias x Profesor') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.grades.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.grades.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span class="nav-text">{{ __('Calificaciones') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.attendances.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.attendances.index') }}">
                    <i class="bi bi-check-square"></i>
                    <span class="nav-text">{{ __('Asistencia') }}</span>
                </a>
            </li>
        @endrole

        {{-- Secretaría Académica --}}
        @role('secretary')
            <li class="nav-item mt-2">
                <div class="sidebar-section">
                    <small>{{ __('Secretaría') }}</small>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('secretary.students.*') ? 'active' : '' }}"
                   href="{{ route('secretary.students.index') }}">
                    <i class="bi bi-mortarboard"></i>
                    <span class="nav-text">{{ __('Estudiantes') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('secretary.enrollments.*') ? 'active' : '' }}"
                   href="{{ route('secretary.enrollments.index') }}">
                    <i class="bi bi-file-earmark-plus"></i>
                    <span class="nav-text">{{ __('Matrículas') }}</span>
                </a>
            </li>
        @endrole

        {{-- Coordinador Académico --}}
        @role('coordinator')
            <li class="nav-item mt-2">
                <div class="sidebar-section">
                    <small>{{ __('Coordinación') }}</small>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.courses.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.courses.index') }}">
                    <i class="bi bi-diagram-3"></i>
                    <span class="nav-text">{{ __('Cursos') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.subjects.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.subjects.index') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span class="nav-text">{{ __('Materias') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.course-subjects.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.course-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    <span class="nav-text">{{ __('Materias x Curso') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.teacher-subjects.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.teacher-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    <span class="nav-text">{{ __('Materias x Profesor') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.rooms.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.rooms.index') }}">
                    <i class="bi bi-building"></i>
                    <span class="nav-text">{{ __('Ambientes') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.schedules.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    <span class="nav-text">{{ __('Horarios') }}</span>
                </a>
            </li>
        @endrole

        {{-- Profesor --}}
        @role('teacher')
            <li class="nav-item mt-2">
                <div class="sidebar-section">
                    <small>{{ __('Docencia') }}</small>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('teacher.schedules.*') ? 'active' : '' }}"
                   href="{{ route('teacher.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    <span class="nav-text">{{ __('Mi Horario') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('teacher.grades.*') ? 'active' : '' }}"
                   href="{{ route('teacher.grades.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span class="nav-text">{{ __('Calificaciones') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('teacher.attendances.*') ? 'active' : '' }}"
                   href="{{ route('teacher.attendances.index') }}">
                    <i class="bi bi-check-square"></i>
                    <span class="nav-text">{{ __('Asistencia') }}</span>
                </a>
            </li>
        @endrole

        {{-- Estudiante --}}
        @role('student')
            <li class="nav-item mt-2">
                <div class="sidebar-section">
                    <small>{{ __('Académico') }}</small>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.schedules.*') ? 'active' : '' }}"
                   href="{{ route('student.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    <span class="nav-text">{{ __('Mi Horario') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.grades.*') ? 'active' : '' }}"
                   href="{{ route('student.grades.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span class="nav-text">{{ __('Mis Notas') }}</span>
                </a>
            </li>
        @endrole

        {{-- Rector/Dirección --}}
        @role('rector')
            <li class="nav-item mt-2">
                <div class="sidebar-section">
                    <small>{{ __('Dirección') }}</small>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('rector.dashboard') ? 'active' : '' }}"
                   href="{{ route('rector.dashboard') }}">
                    <i class="bi bi-building"></i>
                    <span class="nav-text">{{ __('Panel Institucional') }}</span>
                </a>
            </li>
        @endrole
    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-decoration-none">
                <i class="bi bi-box-arrow-left"></i>
                <span class="logout-text ms-2">{{ __('Cerrar Sesión') }}</span>
            </button>
        </form>
    </div>
</nav>
