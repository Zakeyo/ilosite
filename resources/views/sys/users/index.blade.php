@extends('layouts.sidebar')

@section('content')

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif


    <a class="btn btn-secondary" href="{{ route('sys.users.create') }}">+ Crear Usuario</a>

    <table>
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
                        <a class="btn" href="{{ route('sys.users.edit', $user) }}">Editar</a>
                        <a href="{{ route('sys.users.show', $user->id) }}" class="btn btn-show">Ver</a>

                        <form action="{{ route('sys.users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                Eliminar
                            </button>
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

    <a class="btn" href="{{ route('sys') }}">← Volver al sistema</a>
@endsection
