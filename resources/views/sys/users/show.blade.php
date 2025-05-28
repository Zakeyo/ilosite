<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Usuario</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .info {
            margin: 20px 0;
        }

        .label {
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
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
    <h1>Detalle del Usuario</h1>

    <div class="info">
        <p><span class="label">ID:</span> {{ $user->id }}</p>
        <p><span class="label">Nombre:</span> {{ $user->name }}</p>
        <p><span class="label">Email:</span> {{ $user->email }}</p>
        <p><span class="label">Creado:</span> {{ $user->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <a href="{{ route('sys.users.index') }}" class="btn">Volver</a>
</body>
</html>
