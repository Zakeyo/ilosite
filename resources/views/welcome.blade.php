<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Licencias Internacionales</title>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>
  <!-- NAVBAR con botón de login -->
  <nav class="navbar">
    <div class="nav-contenedor">
      <span class="logo">Licencias Internacionales</span>
      <a href="{{ url('/sys') }}" class="btn-nav">Entrar al sistema</a>
    </div>
  </nav>

  <!-- HERO -->
  <div class="hero">
    <div class="overlay">
      <div class="contenedor">
        <h1 class="titulo">Consulta de Licencias Internacionales</h1>
        <p class="subtitulo">Accede fácilmente a la información de licencias asociadas</p>

        <div class="botones">
          <a href="{{ url('/search') }}" class="btn-principal">📋 Ir a consulta</a>
        </div>
      </div>
    </div>
  </div>

  <!-- SECCIÓN SOBRE NOSOTROS -->
  <section class="nosotros">
    <div class="contenedor">
      <h2>Sobre nosotros</h2>
      <p>
        Somos una plataforma dedicada a la gestión y búsqueda de licencias internacionales asociadas a usuarios registrados. Nuestra misión es facilitar el acceso rápido, confiable y seguro a información clave para instituciones y profesionales.
      </p>
      <p>
        Con tecnología moderna y un enfoque centrado en el usuario, ofrecemos soluciones que automatizan procesos, reducen tiempos y mejoran la transparencia.
      </p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="contenedor">
      <p>&copy; {{ date('Y') }} Sistema de Licencias Internacionales. Todos los derechos reservados.</p>
    </div>
  </footer>
</body>
</html>
