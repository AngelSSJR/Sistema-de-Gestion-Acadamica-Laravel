@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square text-warning me-2"></i>Editar Curso
        </h2>
        <a href="{{ route($routePrefix . 'courses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route($routePrefix . 'courses.update', $course) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $course->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="code" class="form-label">Código *</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $course->code) }}" required>
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="level" class="form-label">Nivel</label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                            <option value="">Seleccionar...</option>
                            @foreach(['Preescolar', 'Primaria', 'Secundaria', 'Bachillerato', 'Universitario'] as $lvl)
                                <option value="{{ $lvl }}" @selected(old('level', $course->level) == $lvl)>{{ $lvl }}</option>
                            @endforeach
                        </select>
                        @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="section" class="form-label">Sección</label>
                        <select class="form-select @error('section') is-invalid @enderror" id="section" name="section">
                            <option value="">Seleccionar...</option>
                            @foreach(range('A', 'E') as $letra)
                                <option value="{{ $letra }}" @selected(old('section', $course->section) == $letra)>{{ $letra }}</option>
                            @endforeach
                        </select>
                        @error('section') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="academic_year" class="form-label">Año Académico</label>
                        <input type="text" class="form-control @error('academic_year') is-invalid @enderror" id="academic_year" name="academic_year" value="{{ old('academic_year', $course->academic_year) }}">
                        @error('academic_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-check mt-4">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @checked(old('is_active', $course->is_active))>
                            <label class="form-check-label" for="is_active">Curso activo</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Actualizar
                    </button>
                    <a href="{{ route($routePrefix . 'courses.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
