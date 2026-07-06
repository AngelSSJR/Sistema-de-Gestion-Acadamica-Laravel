@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">{{ __('Dashboard') }}</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="mb-0">{{ __("¡Has iniciado sesión!") }}</p>
            </div>
        </div>
    </div>
@endsection
