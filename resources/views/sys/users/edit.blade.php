<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 500px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 20px;
            background-color: #38c172;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #2f9e68;
        }

        .back-btn {
            background-color: #3490dc;
        }

        .back-btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <h1>Crear Nuevo Usuario</h1>

    <form action="{{ route('sys.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Correo:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label for="password">Nueva Contraseña (opcional):</label>
        <input type="password" name="password">

        <button class="btn" type="submit">Actualizar</button>
    </form>

    <br>
    <a class="btn back-btn" href="{{ route('sys.users.index') }}">← Volver a la lista</a>
</body>
</html>
