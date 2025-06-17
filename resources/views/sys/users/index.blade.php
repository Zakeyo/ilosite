@extends('layouts.sidebar')

@section('content')

<div class="glass-card">

  @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

  <h1 class="glass-title">Usuarios Registrados</h1>

    <a href="{{ route('sys.users.create') }}" class="btn-agregar">+ Crear Usuario</a>

<div class="glass-section mt-3">
  <div class="table-responsive">
    <table class="glass-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="actions">
              <a href="{{ route('sys.users.show', $user->id) }}" class="btn-accion btn-ver">Ver</a>
              <a href="{{ route('sys.users.edit', $user) }}" class="btn-accion btn-editar">Editar</a>
              <form action="{{ route('sys.users.destroy', $user->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-accion btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3">No hay usuarios registrados.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
  {{-- <a class="btn-back" href="{{ route('sys') }}">← Volver al sistema</a> --}}
</div>
@endsection
