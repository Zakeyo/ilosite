@extends('layouts.sidebar')
@section('content')

<div class="glass-card">
  <h2>Editar Usuario</h2>

  <form action="{{ route('sys.users.update', $user->id) }}" method="POST" class="form-glass">
    @csrf
    @method('PUT')

    <label for="name">Nombre:</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

    <label for="email">Correo:</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

    <label for="password">Nueva Contraseña (opcional):</label>
    <input type="password" name="password">

    <button class="btn-glass submit" type="submit">🔄 Actualizar</button>
  </form>

  <a class="btn-back" href="{{ route('sys.users.index') }}">← Volver a la lista</a>
</div>



@endsection