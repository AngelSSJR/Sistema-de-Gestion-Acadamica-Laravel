@extends('layouts.app')

@section('title', 'Ambientes')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-building text-info me-2"></i>Ambientes (Salones/Aulas)
        </h2>
        <a href="{{ route($routePrefix . 'rooms.create') }}" class="btn btn-info text-white">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Ambiente
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Capacidad</th>
                            <th>Recursos</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>
                                    <a href="{{ route($routePrefix . 'rooms.show', $room) }}" class="text-decoration-none fw-medium">
                                        {{ $room->name }}
                                    </a>
                                </td>
                                <td><span class="badge bg-secondary">{{ $room->code }}</span></td>
                                <td>{{ $room->capacity ?? '—' }}</td>
                                <td>{{ Str::limit($room->resources, 40) ?? '—' }}</td>
                                <td>
                                    @if($room->is_active)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route($routePrefix . 'rooms.show', $room) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . 'rooms.edit', $room) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route($routePrefix . 'rooms.destroy', $room) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar este ambiente?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No hay ambientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@endsection
