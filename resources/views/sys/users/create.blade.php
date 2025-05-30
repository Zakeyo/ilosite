@extends('layouts.sidebar')

@section('content')
    <h1>Crear Nuevo Usuario</h1>

    <form method="POST" action="{{ route('sys.users.store') }}">
        @csrf

        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" class="btn">Crear Usuario</button>
    </form>

    <br>
    <a class="btn back-btn" href="{{ route('sys.users.index') }}">← Volver a la lista</a>
@endsection