@extends('layouts.app')

@section('content')
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container mt-4 font-sans antialiased min-h-screen bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" >
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Nueva cita</h1>
    <form action="{{ route('citas.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="fecha" class="form-label">Seleccionar Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Seleccionar Hora</label>
            <input type="time" id="hora" name="hora" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Solicitar Nueva Cita</button>
    </form>

    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Mis citas</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
