<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Sistema</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <h1>Bienvenido al Sistema</h1>

    <p>Hola, {{ $user->name }}</p>

    <div>
        <a class="btn" href="{{ route('sys.users.index') }}">Gestión de Usuarios</a>
        <a class="btn" href="{{ route('search') }}">Buscar Personas</a>
        <a class="btn" href="{{ route('welcome') }}">Ir a la Página Principal</a>
        
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn" style="background-color: #e3342f;">
                Cerrar Sesión
            </button>
        </form>
    </div>
</body>
</html>
