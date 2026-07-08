<nav class="sidebar d-flex flex-column">
    <div class="p-3 border-bottom border-secondary">
        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none d-flex align-items-center">
            <img src="{{ asset('img/ChatGPT Image 7 jul 2026, 22_08_36.png') }}" alt="UF" height="32">
        </a>
    </div>

    <div class="p-3 border-bottom border-secondary">
        <small class="text-secondary text-uppercase fw-semibold">{{ __('Menú Principal') }}</small>
    </div>

    <ul class="nav flex-column mt-2 flex-grow-1">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}"
               href="{{ route(auth()->user()->getDashboardRoute()) }}">
                <i class="bi bi-speedometer2"></i>
                {{ __('Dashboard') }}
            </a>
        </li>

        {{-- Desarrollador/Administrador --}}
        @role('dev_admin')
            <li class="nav-item mt-2">
                <small class="text-secondary text-uppercase px-3 fw-semibold">{{ __('Sistema') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.users.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.users.index') }}">
                    <i class="bi bi-people-fill"></i>
                    {{ __('Usuarios') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.teachers.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.teachers.index') }}">
                    <i class="bi bi-person-badge"></i>
                    {{ __('Profesores') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.students.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.students.index') }}">
                    <i class="bi bi-mortarboard"></i>
                    {{ __('Estudiantes') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.courses.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.courses.index') }}">
                    <i class="bi bi-diagram-3"></i>
                    {{ __('Cursos') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.subjects.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.subjects.index') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    {{ __('Materias') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.enrollments.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.enrollments.index') }}">
                    <i class="bi bi-file-earmark-plus"></i>
                    {{ __('Matrículas') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.rooms.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.rooms.index') }}">
                    <i class="bi bi-building"></i>
                    {{ __('Ambientes') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.schedules.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    {{ __('Horarios') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.course-subjects.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.course-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    {{ __('Materias x Curso') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.teacher-subjects.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.teacher-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    {{ __('Materias x Profesor') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.grades.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.grades.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    {{ __('Calificaciones') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dev-admin.attendances.*') ? 'active' : '' }}"
                   href="{{ route('dev-admin.attendances.index') }}">
                    <i class="bi bi-check-square"></i>
                    {{ __('Asistencia') }}
                </a>
            </li>
        @endrole

        {{-- Secretaría Académica --}}
        @role('secretary')
            <li class="nav-item mt-2">
                <small class="text-secondary text-uppercase px-3 fw-semibold">{{ __('Secretaría') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('secretary.students.*') ? 'active' : '' }}"
                   href="{{ route('secretary.students.index') }}">
                    <i class="bi bi-mortarboard"></i>
                    {{ __('Estudiantes') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('secretary.enrollments.*') ? 'active' : '' }}"
                   href="{{ route('secretary.enrollments.index') }}">
                    <i class="bi bi-file-earmark-plus"></i>
                    {{ __('Matrículas') }}
                </a>
            </li>

        @endrole

        {{-- Coordinador Académico --}}
        @role('coordinator')
            <li class="nav-item mt-2">
                <small class="text-secondary text-uppercase px-3 fw-semibold">{{ __('Coordinación') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.courses.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.courses.index') }}">
                    <i class="bi bi-diagram-3"></i>
                    {{ __('Cursos') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.subjects.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.subjects.index') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    {{ __('Materias') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.course-subjects.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.course-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    {{ __('Materias x Curso') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.teacher-subjects.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.teacher-subjects.index') }}">
                    <i class="bi bi-link-45deg"></i>
                    {{ __('Materias x Profesor') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.rooms.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.rooms.index') }}">
                    <i class="bi bi-building"></i>
                    {{ __('Ambientes') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('coordinator.schedules.*') ? 'active' : '' }}"
                   href="{{ route('coordinator.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    {{ __('Horarios') }}
                </a>
            </li>
        @endrole

        {{-- Profesor --}}
        @role('teacher')
            <li class="nav-item mt-2">
                <small class="text-secondary text-uppercase px-3 fw-semibold">{{ __('Docencia') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('teacher.schedules.*') ? 'active' : '' }}"
                   href="{{ route('teacher.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    {{ __('Mi Horario') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('teacher.grades.*') ? 'active' : '' }}"
                   href="{{ route('teacher.grades.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    {{ __('Calificaciones') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('teacher.attendances.*') ? 'active' : '' }}"
                   href="{{ route('teacher.attendances.index') }}">
                    <i class="bi bi-check-square"></i>
                    {{ __('Asistencia') }}
                </a>
            </li>
        @endrole

        {{-- Estudiante --}}
        @role('student')
            <li class="nav-item mt-2">
                <small class="text-secondary text-uppercase px-3 fw-semibold">{{ __('Académico') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.schedules.*') ? 'active' : '' }}"
                   href="{{ route('student.schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    {{ __('Mi Horario') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.grades.*') ? 'active' : '' }}"
                   href="{{ route('student.grades.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    {{ __('Mis Notas') }}
                </a>
            </li>
        @endrole

        {{-- Rector/Dirección --}}
        @role('rector')
            <li class="nav-item mt-2">
                <small class="text-secondary text-uppercase px-3 fw-semibold">{{ __('Dirección') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('rector.dashboard') ? 'active' : '' }}"
                   href="{{ route('rector.dashboard') }}">
                    <i class="bi bi-building"></i>
                    {{ __('Panel Institucional') }}
                </a>
            </li>
        @endrole
    </ul>

    <div class="p-3 border-top border-secondary">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-decoration-none text-white-50 w-100 text-start px-3 py-2">
                <i class="bi bi-box-arrow-left me-2"></i>
                {{ __('Cerrar Sesión') }}
            </button>
        </form>
    </div>
</nav>
