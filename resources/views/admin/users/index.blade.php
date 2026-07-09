@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0"><i class="bi bi-people-fill me-2"></i>Usuarios del Sistema</h2>
            <a href="{{ route('dev-admin.users.create') }}" class="btn btn-dark">
                <i class="bi bi-person-plus me-1"></i>Nuevo Usuario
            </a>
        </div>

        <div class="card">
            <div class="card-body p-0">
                @include('partials.search-form')
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Registro</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="fw-medium">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? '—' }}</td>
                                    <td>
                                        @php
                                            $role = $user->roles->first();
                                            $badge = match ($role?->name) {
                                                'dev_admin' => 'bg-dark',
                                                'secretary' => 'bg-primary',
                                                'coordinator' => 'bg-info',
                                                'teacher' => 'bg-success',
                                                'student' => 'bg-warning text-dark',
                                                'rector' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        @if ($role)
                                            <span class="badge {{ $badge }}">{{ $role->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('dev-admin.users.show', $user) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('dev-admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('dev-admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Eliminar este usuario?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No hay usuarios registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($users->hasPages())
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
