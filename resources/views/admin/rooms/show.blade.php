@extends('layouts.app')

@section('title', 'Detalle del Ambiente')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-building text-info me-2"></i>{{ $room->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route($routePrefix . 'rooms.edit', $room) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ route($routePrefix . 'rooms.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <dl>
                        <dt>Nombre</dt>
                        <dd class="fs-5">{{ $room->name }}</dd>
                        <dt>Código</dt>
                        <dd><span class="badge bg-secondary fs-6">{{ $room->code }}</span></dd>
                        <dt>Capacidad</dt>
                        <dd>{{ $room->capacity ? "$room->capacity personas" : 'No especificada' }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt>Recursos</dt>
                        <dd>{{ $room->resources ?? 'No especificados' }}</dd>
                        <dt>Estado</dt>
                        <dd>
                            @if($room->is_active)
                                <span class="badge bg-success fs-6">Activo</span>
                            @else
                                <span class="badge bg-secondary fs-6">Inactivo</span>
                            @endif
                        </dd>
                        <dt>Registrado</dt>
                        <dd>{{ $room->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
