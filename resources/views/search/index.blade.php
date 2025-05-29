<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Licencias</title>

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    <!-- AOS Animaciones -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
</head>
<body>

<div class="glass-card" data-aos="fade-up">
  <h1 class="title">Consulta de Licencias Internacionales</h1>

  <form method="GET" action="" class="form-grid">
    <div class="input-group">
      <label for="cedula">Cédula</label>
      <input type="text" id="cedula" name="cedula" placeholder="Ej: V-12.345.678">
    </div>

    <div class="input-group">
      <label for="pasaporte">Pasaporte</label>
      <input type="text" id="pasaporte" name="pasaporte" placeholder="Ej: X1234567">
    </div>

    <div class="input-group">
      <label for="licencia">Licencia</label>
      <input type="text" id="licencia" name="licencia" placeholder="Ej: LIC-98765">
    </div>

    <div class="input-button">
      <button type="submit" class="btn-red-gradient">Buscar</button>
    </div>
  </form>
</div>


    <!-- Script para animaciones -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({ once: false, duration: 800 });
        });
    </script>
    
</body>
</html>
