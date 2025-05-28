<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px 0;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2779bd;
        }

        .btn-secondary {
            background-color: #38c172;
        }

        .btn-secondary:hover {
            background-color: #2f9e68;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actions a {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <h1>Gestión de Usuarios</h1>

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
</body>
</html>
