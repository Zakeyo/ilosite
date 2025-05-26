<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 40px;
        }
        h1 {
            font-size: 2.5rem;
        }
        .btn-container {
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 1rem;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>PÁGINA PRINCIPAL</h1>
    <h3>Sobre nosotros, quienes somos, lo que hacemos, etc etc</h3>

    <div class="btn-container">
        <a href="{{ url('/search') }}" class="btn">Ir al buscador</a>
        <a href="{{ url('/sys') }}" class="btn">Entrar al sistema</a>
    </div>
</body>
</html>
