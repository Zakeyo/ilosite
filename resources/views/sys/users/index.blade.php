@extends('layouts.sidebar')

@section('content')

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif


<div class="glass-card">
  <div class="header-actions">
    <h2>Usuarios Registrados</h2>
    <a class="btn-create" href="{{ route('sys.users.create') }}">+ Crear Usuario</a>
  </div>

  <div class="table-container">
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
              <a class="btn-glass edit" href="{{ route('sys.users.edit', $user) }}">✏️ Editar</a>
              <a class="btn-glass view" href="{{ route('sys.users.show', $user->id) }}">🔍 Ver</a>
              <form action="{{ route('sys.users.destroy', $user->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-glass delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">🗑️ Eliminar</button>
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

  <a class="btn-back" href="{{ route('sys') }}">← Volver al sistema</a>
</div>
@endsection
