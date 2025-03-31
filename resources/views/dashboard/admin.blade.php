@extends('layouts.app')

@section('content')
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container mt-4 font-sans antialiased min-h-screen bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" >
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Administrador - Gestión de Citas</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->user->name }}</td>
                    <td>
                        <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="date" name="fecha" value="{{ $cita->fecha }}" class="form-control" required>
                            <input type="time" name="hora" value="{{ $cita->hora }}" class="form-control mt-1" required>
                    </td>
                    <td>
                            <select name="estado" class="form-select">
                                <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Aceptado" {{ $cita->estado == 'Aceptado' ? 'selected' : '' }}>Aceptado</option>
                                <option value="Rechazado" {{ $cita->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                    </td>
                    <td>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection