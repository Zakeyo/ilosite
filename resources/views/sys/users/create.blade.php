@extends('layouts.sidebar')

@section('content')
<div class="glass-card">
  <h2>Crear Nuevo Usuario</h2>

  <form method="POST" action="{{ route('sys.users.store') }}" class="form-glass">
    @csrf

    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Correo electrónico</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" required>

    <button type="submit" class="btn-glass submit">✅ Crear Usuario</button>
  </form>

  <a class="btn-back" href="{{ route('sys.users.index') }}">← Volver a la lista</a>
</div>

@endsection