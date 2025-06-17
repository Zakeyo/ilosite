<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Licencias</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- AOS Animaciones -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>

</head>
<body>

<div class="glass-card" data-aos="fade-up">
  <h1 class="title">Consulta de Licencias Internacionales</h1>

  <form action="{{ route('search') }}" method="GET" class="glass-form">
  <h2 class="glass-title">Buscar Solicitante</h2>

  <div class="glass-form-group">
    <select name="tipo" required class="glass-input">
      <option value="" disabled selected>Seleccione tipo de búsqueda</option>
      <option value="cedula">Cédula</option>
      <option value="pasaporte">Pasaporte</option>
      <option value="licencia">Número de Licencia</option>
    </select>

    <input type="text" name="valor" class="glass-input" placeholder="Ingrese el dato a buscar" required>

    
  </div>

  <div class="d-flex justify-content-center gap-3 mt-4"> 
    <a href="{{ route('welcome') }}" class="btn-inicio">Inicio</a>
    <button type="submit" class="btn-buscar">Buscar</button>
  </div> 
</form>

@if(request()->filled('valor'))
<div class="glass-card mt-10 resultado-consulta" >
  <h2 class="glass-title">Resultado de la búsqueda</h2>

  @php
  $emoji = '';
  if ($applicant && $applicant->country_of_origin) {
      $allCountries = config('countries');
      $paisNombre = $applicant->country_of_origin;
      $codigo = array_search($paisNombre, $allCountries);
      $emoji = $codigo
        ? mb_convert_encoding(
            '&#' . (127397 + ord($codigo[0])) . ';' .
            '&#' . (127397 + ord($codigo[1])) . ';',
            'UTF-8',
            'HTML-ENTITIES'
          )
        : '';
  }
@endphp


  @if($applicant)
    <div class="glass-profile" data-aos="fade-up">
      <!-- COLUMNA ARRIBA -->
      <div class="glass-left" data-aos="fade-in">
        <h3 class="glass-subtitle">🧍 Información Personal</h3>

        <div class="row">
          <!-- Columna izquierda --> 
          <div class="col-md-6 text-start ps-5">
            <p><strong>Nombre completo:</strong> {{ $applicant->first_name }} {{ $applicant->last_name }}</p>
            <p><strong>Cédula / ID:</strong> {{ $applicant->id_number }}</p>
            <p><strong>Correo:</strong> {{ $applicant->email ?? 'No especificado' }}</p>
            <p><strong>País:</strong> {!! $emoji !!} {{ $paisNombre ?? 'No especificado' }}</p>
            <p><strong>Teléfono:</strong> {{ $applicant->phone_1 ?? 'No registrado' }}</p>
          </div>

          <!-- Columna derecha -->
          <div class="col-md-6 text-start ps-5">
            <p><strong>Pasaporte:</strong> {{ $applicant->passport_number ?? 'No registrado' }}</p>
            <p><strong>Estatura:</strong> {{ $applicant->height_cm ?? '-' }} cm</p>
            <p><strong>Ojos:</strong> {{ $applicant->eye_color ?? '-' }}</p>
            <p><strong>Sangre:</strong> {{ $applicant->blood_type ?? '-' }}</p>
          </div>
        </div>
      </div>


      <!-- COLUMNA ABAJO -->
    <div class="glass-right" data-aos="fade-in">
        <h3 class="glass-subtitle">🪪 Licencia Internacional</h3>

      <div class="row">

        <!-- Columna izquierda --> 
        <div class="col-md-6 text-start ps-5">
        @if($applicant->license)
          <p><strong>Tipo:</strong> {{ $applicant->license->license_type }}</p>
          <p><strong>Duración:</strong> {{ $applicant->license->duration }}</p>
          <p><strong>Estado:</strong> {{ ucfirst($applicant->license->status) }}</p>
        </div>

        <!-- Columna derecha -->
        <div class="col-md-6 text-start ps-5">
          {{-- <p><strong>N° trámite:</strong> {{ $applicant->license->transaction_number }}</p> --}}
          <p><strong>Emitida:</strong> {{ $applicant->license->issued_at?->format('d/m/Y') ?? '-' }}</p>
          <p><strong>Expira:</strong> {{ $applicant->license->expires_at?->format('d/m/Y') ?? '-' }}</p>
        </div>
        @else
          <p><em>No posee licencia registrada.</em></p>
        @endif
        
      </div>
    </div>
      <!-- COLUMNA ADJUNTOS -->
      <div class="glass-bottom" data-aos="fade-in">
        <h3 class="glass-subtitle">📎 Archivos Adjuntos</h3>

        @if($applicant && $applicant->license && $applicant->license->attachments->count())
            <div class="adjuntos-grid">
                @foreach($applicant->license->attachments->whereIn('type', ['license_front', 'license_back']) as $attachment)
                    @if(Str::endsWith($attachment->file_path, ['.jpg', '.jpeg', '.png', '.webp']))
                        <div class="canvas-licencia-wrapper img-preview">
                          <canvas
                            class="canvas-protegido"
                            width="180"
                            height="200"
                            data-src="{{ asset('storage/' . $attachment->file_path) }}"
                            onclick="mostrarModal(this.dataset.src, '{{ ucfirst(str_replace('_', ' ', $attachment->type)) }}')"
                            style="touch-action: none; cursor: grab;"
                          ></canvas>
                          <p class="canvas-label">{{ ucfirst(str_replace('_', ' ', $attachment->type)) }}</p>
                        </div>
                    @else
                        <p><a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ $attachment->type }}</a></p>
                    @endif
                @endforeach
            </div>
        </div>
        @else
            <p>No hay archivos cargados.</p>
        @endif
      </div>
  @else
    <div class="glass-card mt-5" data-aos="fade-in">
      <p style="font-size: 120%; font-weight:bolder;">No se encontró ningún solicitante con esos datos.</p>
    </div>
  @endif
</div>
@endif

</div>


    <!-- Script para limpiar todo al refrescar -->
    <script>
      if (performance.navigation.type === 1) {
        if (window.location.search) {
          window.location.href = window.location.pathname;
        }
      }
    </script>

    <!-- Script para animaciones -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({ once: false, duration: 800 });
        });
    </script>

    {{-- script para dibujar imagen con canvas --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const canvases = document.querySelectorAll('.canvas-protegido');

          canvases.forEach(canvas => {
            const ctx = canvas.getContext('2d');
            const src = canvas.dataset.src;
            const titulo = canvas.dataset.titulo || 'Vista previa';

            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.src = src;

            img.onload = () => {
              canvas.width = 300;
              canvas.height = 200;
              ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            };

            canvas.addEventListener('contextmenu', e => e.preventDefault());

            canvas.addEventListener('click', () => {
              mostrarModal(src, titulo);
            });
          });
        });

        // === Modal interactivo con scroll + táctil (gestos) ===

        let zoom = 1;
        let offsetX = 0;
        let offsetY = 0;
        let isDragging = false;
        let dragStartX, dragStartY;
        let currentImg;
        let lastTouchDistance = null;

        function mostrarModal(src, titulo) {
          const modal = document.getElementById('modal-canvas');
          const canvas = document.getElementById('modal-canvas-canvas');
          const ctx = canvas.getContext('2d');

          document.getElementById('modal-titulo').textContent = titulo;

          currentImg = new Image();
          currentImg.onload = function () {
            const isMobile = window.innerWidth <= 768;
            const maxWidth = isMobile ? 300 : 500;
            const maxHeight = isMobile ? 400 : 500;

            const ratio = Math.min(maxWidth / this.width, maxHeight / this.height);
            canvas.width = this.width * ratio;
            canvas.height = this.height * ratio;

            zoom = 1;
            offsetX = 0;
            offsetY = 0;

            dibujarImagen(canvas, ctx);
          };

          currentImg.src = src;
          modal.style.display = 'flex';

          // Mouse scroll
          canvas.addEventListener('wheel', function (e) {
            e.preventDefault();
            const delta = e.deltaY > 0 ? -0.1 : 0.1;
            zoom = Math.max(0.5, Math.min(zoom + delta, 4));
            dibujarImagen(canvas, ctx);
          });

          // Mouse drag
          canvas.onmousedown = (e) => {
            isDragging = true;
            dragStartX = e.offsetX - offsetX;
            dragStartY = e.offsetY - offsetY;
            canvas.style.cursor = 'grabbing';
          };

          canvas.onmouseup = () => {
            isDragging = false;
            canvas.style.cursor = 'grab';
          };

          canvas.onmouseleave = () => {
            isDragging = false;
            canvas.style.cursor = 'default';
          };

          canvas.onmousemove = (e) => {
            if (isDragging) {
              offsetX = e.offsetX - dragStartX;
              offsetY = e.offsetY - dragStartY;
              dibujarImagen(canvas, ctx);
            }
          };

          // Táctil: pinch zoom y drag
          canvas.addEventListener('touchstart', function (e) {
            if (e.touches.length === 1) {
              dragStartX = e.touches[0].clientX - offsetX;
              dragStartY = e.touches[0].clientY - offsetY;
            } else if (e.touches.length === 2) {
              lastTouchDistance = getDistance(e.touches[0], e.touches[1]);
            }
          });

          canvas.addEventListener('touchmove', function (e) {
            e.preventDefault();

            if (e.touches.length === 1 && !lastTouchDistance) {
              offsetX = e.touches[0].clientX - dragStartX;
              offsetY = e.touches[0].clientY - dragStartY;
              dibujarImagen(canvas, ctx);
            } else if (e.touches.length === 2) {
              const newDistance = getDistance(e.touches[0], e.touches[1]);
              const scaleChange = newDistance / lastTouchDistance;
              zoom = Math.max(0.5, Math.min(zoom * scaleChange, 4));
              lastTouchDistance = newDistance;
              dibujarImagen(canvas, ctx);
            }
          }, { passive: false });

          canvas.addEventListener('touchend', function () {
            lastTouchDistance = null;
          });

          canvas.oncontextmenu = (e) => e.preventDefault();
        }

        function dibujarImagen(canvas, ctx) {
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          const w = currentImg.width * zoom;
          const h = currentImg.height * zoom;
          const x = (canvas.width - w) / 2 + offsetX;
          const y = (canvas.height - h) / 2 + offsetY;
          ctx.drawImage(currentImg, x, y, w, h);
        }

        function getDistance(t1, t2) {
          const dx = t2.clientX - t1.clientX;
          const dy = t2.clientY - t1.clientY;
          return Math.sqrt(dx * dx + dy * dy);
        }

        function cerrarModal() {
          const modal = document.getElementById('modal-canvas');
          const canvas = document.getElementById('modal-canvas-canvas');
          const ctx = canvas.getContext('2d');
          modal.style.display = 'none';
          ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    </script>





<!-- html para el modal -->
<div id="modal-canvas" class="modal-canvas-overlay" onclick="cerrarModal()">
  <div class="modal-canvas-content" onclick="event.stopPropagation()">
    <h4 id="modal-titulo" class="mb-3 text-center"></h4>
    <div class="canvas-container">
      <canvas id="modal-canvas-canvas"></canvas>
    </div>
    <button onclick="cerrarModal()" class="btn-cerrar-modal">Cerrar</button>
  </div>
</div>

</body>
</html>
