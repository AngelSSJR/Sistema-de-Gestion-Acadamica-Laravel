@extends('layouts.app')

@section('title', 'Editar Horario')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square text-warning me-2"></i>Editar Horario
        </h2>
        <a href="{{ route($routePrefix . 'schedules.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route($routePrefix . 'schedules.update', $schedule) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Curso *</label>
                        <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected(old('course_id', $schedule->course_id) == $course->id)>{{ $course->name }} ({{ $course->code }})</option>
                            @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="subject_id" class="form-label">Materia *</label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" @selected(old('subject_id', $schedule->subject_id) == $subject->id)>{{ $subject->name }} ({{ $subject->code }})</option>
                            @endforeach
                        </select>
                        @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="teacher_id" class="form-label">Profesor *</label>
                        <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" required>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @selected(old('teacher_id', $schedule->teacher_id) == $teacher->id)>{{ $teacher->user->name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Días de la semana *</label>
                        <div class="d-flex flex-wrap gap-3 pt-1">
                            @foreach(['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado'] as $val => $label)
                                <div class="form-check">
                                    <input class="form-check-input @error('day_of_week') is-invalid @enderror" type="checkbox"
                                           id="day_{{ $val }}" name="day_of_week[]" value="{{ $val }}"
                                           @checked(in_array($val, old('day_of_week', $schedule->day_of_week ?? [])))>
                                    <label class="form-check-label" for="day_{{ $val }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('day_of_week') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @error('day_of_week.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="start_time" class="form-label">Hora inicio *</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', substr($schedule->start_time, 0, 5)) }}" required>
                        @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="end_time" class="form-label">Hora fin *</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', substr($schedule->end_time, 0, 5)) }}" required>
                        @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="room_id" class="form-label">Ambiente</label>
                        <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
                            <option value="">Seleccionar ambiente...</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" @selected(old('room_id', $schedule->room_id) == $room->id)>{{ $room->name }} ({{ $room->code }})</option>
                            @endforeach
                        </select>
                        @error('room_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="academic_period" class="form-label">Período</label>
                        <input type="text" class="form-control @error('academic_period') is-invalid @enderror" id="academic_period" name="academic_period" value="{{ old('academic_period', $schedule->academic_period) }}">
                        @error('academic_period') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Actualizar
                    </button>
                    <a href="{{ route($routePrefix . 'schedules.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
