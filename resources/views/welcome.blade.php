<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Licencias Internacionales</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" data-aos="fade-in">
        <div class="nav-contenedor">
            <div class="logo">Licencias Global</div>
            <a href="{{ url('/sys') }}" class="btn-nav">🔐 Entrar al sistema</a>
        </div>
    </nav>

    <!-- Hero principal -->
    <header class="hero" id="inicio" data-aos="fade-in">
        <div class="hero-overlay" data-aos="fade-up">
            <h1  data-aos="zoom-in">Consulta licencias internacionales</h1>
            <p  data-aos="fade-in">Accede rápidamente a la base de datos de licencias asociadas a usuarios registrados.</p>
            <a href="{{ url('/search') }}" class="btn-hero">📋 Ir a consulta</a>
        </div>
    </header>

    <!-- Sobre nosotros -->
  <section class="sobre-nosotros" id="nosotros">
    <h2  data-aos="zoom-in">Sobre Nosotros</h2>
    <p  data-aos="fade-in">Somos una plataforma dedicada a simplificar el acceso a información de licencias internacionales.</p>
  </section>

    <!-- Tarjetas con animacion -->
  <section class="caracteristicas" data-aos="fade-up">
    <h2>Nuestras Características</h2>
    <div class="tarjetas-contenedor" data-aos="fade-right">
        <div class="tarjeta">
            <img src="/images/icono1.png" alt="Rapidez">
            <h3>Consulta Rápida</h3>
            <p>Obtén resultados en segundos gracias a nuestra infraestructura optimizada.</p>
        </div>
        <div class="tarjeta">
            <img src="/images/icono2.png" alt="Precisión">
            <h3>Alta Precisión</h3>
            <p>Datos actualizados y vinculados a registros internacionales verificados.</p>
        </div>
        <div class="tarjeta">
            <img src="/images/icono3.png" alt="Soporte">
            <h3>Soporte Global</h3>
            <p>Acceso desde cualquier parte del mundo con soporte en varios idiomas.</p>
        </div>
    </div>
</section>

<!-- Sección de Testimonios / Slider -->
<section class="testimonios" data-aos="fade-up">
    <h2>Lo que dicen nuestros usuarios</h2>
    <div class="slider">
        <div class="slide active">
            <p>"El sistema me permitió encontrar mis licencias internacionales en segundos. ¡Muy intuitivo!"</p>
            <h4>— Ana Gómez</h4>
        </div>
        <div class="slide">
            <p>"Excelente herramienta para gestionar registros internacionales. Recomendado 100%."</p>
            <h4>— Carlos Méndez</h4>
        </div>
        <div class="slide">
            <p>"La interfaz es moderna y fácil de usar, además el soporte es excelente."</p>
            <h4>— Laura Fernández</h4>
        </div>
    </div>
</section>


<!-- Sección de Contacto con imagen -->
<section class="contacto" id="contacto" data-aos="fade-up">
  <div class="contacto-contenedor">
    
    <!-- Columna izquierda: formulario -->
    <div class="formulario-columna" data-aos="fade-right">
      <h2>Contáctanos</h2>
      <p>¿Tienes dudas o necesitas ayuda? Estamos para servirte.</p>

      <form class="formulario-contacto">
        <input type="text" placeholder="Tu nombre" required>
        <input type="email" placeholder="Tu correo electrónico" required>
        <textarea rows="5" placeholder="Tu mensaje" required></textarea>
        <button type="submit">Enviar</button>
      </form>
    </div>

    <!-- Columna derecha: imagen -->
    <div class="imagen-contacto" data-aos="fade-left">
      <img src="{{ asset('images/imagen_contacto.jpg') }}" alt="Imagen de contacto">
    </div>

  </div>
</section>



    <!-- Sección de Footer -->
<footer class="footer" data-aos="fade-right">
  <div class="footer-contenedor">
    <div class="footer-info">
      <h3>Licencias Globales</h3>
      <p>Una plataforma para gestionar y consultar licencias internacionales con facilidad.</p>
    </div>

    <div class="footer-enlaces">
      <a href="#">Inicio</a>
      <a href="#nosotros">Sobre Nosotros</a>
      <a href="#">Consulta</a>
      <a href="#contacto">Contacto</a>
    </div>

    <div class="footer-social">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
      <div class="footer-copy">
        © 2025 Licencias Globales. Todos los derechos reservados.
      </div>
  </div>
</footer>


<!-- Script para dar efecto fade in a las secciones -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // Duración de la animación en milisegundos
    once: false      // Solo se ejecuta una vez al hacer scroll
  });
</script>

<script>
    // Rotación automática de testimonios
    let slides = document.querySelectorAll(".slide");
    let current = 0;

    setInterval(() => {
        slides[current].classList.remove("active");
        current = (current + 1) % slides.length;
        slides[current].classList.add("active");
    }, 5000); // Cambia cada 5 segundos
</script>

</body>
</html>
