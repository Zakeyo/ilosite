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

  <form action="{{ route('search') }}" method="GET" class="glass-form">
  <h2 class="glass-title">💻 Buscar Solicitante</h2>

  <div class="glass-form-group">
    <select name="tipo" required class="glass-input">
      <option value="" disabled selected>Seleccione tipo de búsqueda</option>
      <option value="cedula">Cédula</option>
      <option value="pasaporte">Pasaporte</option>
      <option value="licencia">Número de Licencia</option>
    </select>

    <input type="text" name="valor" class="glass-input" placeholder="Ingrese el dato a buscar" required>

    <button type="submit" class="btn-red-gradient">Buscar</button>
  </div>
</form>

@if(request()->filled('valor'))
<div class="glass-card mt-10 resultado-consulta" >
  <h2 class="glass-title">🧾 Resultado de la búsqueda</h2>

  @if($applicant)
    <div class="glass-profile" data-aos="fade-up">
      <!-- COLUMNA IZQUIERDA -->
      <div class="glass-left" data-aos="fade-in">
        <h3>🧍 Información Personal</h3>
        <p><strong>Nombre completo:</strong> {{ $applicant->first_name }} {{ $applicant->last_name }}</p>
        <p><strong>Cédula / ID:</strong> {{ $applicant->id_number }}</p>
        <p><strong>Correo:</strong> {{ $applicant->email ?? 'No especificado' }}</p>
        <p><strong>País:</strong> {{ $applicant->country_of_origin ?? 'No especificado' }}</p>
        <p><strong>Dirección:</strong> {{ $applicant->address_1 ?? 'No especificada' }}</p>
        <p><strong>Teléfono:</strong> {{ $applicant->phone_1 ?? 'No registrado' }}</p>
        <p><strong>Pasaporte:</strong> {{ $applicant->passport_number ?? 'No registrado' }}</p>
        <p><strong>Estatura:</strong> {{ $applicant->height_cm ?? '-' }} cm</p>
        <p><strong>Ojos:</strong> {{ $applicant->eye_color ?? '-' }}</p>
        <p><strong>Sangre:</strong> {{ $applicant->blood_type ?? '-' }}</p>
      </div>

      <!-- COLUMNA DERECHA -->
      <div class="glass-right" data-aos="fade-in">
        <h3>🪪 Licencia Internacional</h3>
        @if($applicant->license)
          <p><strong>Tipo:</strong> {{ $applicant->license->license_type }}</p>
          <p><strong>Duración:</strong> {{ $applicant->license->duration }}</p>
          <p><strong>Estado:</strong> {{ ucfirst($applicant->license->status) }}</p>
          <p><strong>N° trámite:</strong> {{ $applicant->license->transaction_number }}</p>
          <p><strong>Emitida:</strong> {{ $applicant->license->issued_at?->format('d/m/Y') ?? '-' }}</p>
          <p><strong>Expira:</strong> {{ $applicant->license->expires_at?->format('d/m/Y') ?? '-' }}</p>
        @else
          <p><em>No posee licencia registrada.</em></p>
        @endif

        <h3>📎 Archivos Adjuntos</h3>

        @if($applicant && $applicant->license && $applicant->license->attachments->count())
            <div class="adjuntos-grid">
                @foreach($applicant->license->attachments->whereIn('type', ['license_front', 'license_back']) as $attachment)
                    @if(Str::endsWith($attachment->file_path, ['.jpg', '.jpeg', '.png', '.webp']))
                        <div class="img-preview">
                            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->type }}">
                            </a>
                            <span>{{ ucfirst(str_replace('_', ' ', $attachment->type)) }}</span>
                        </div>
                    @else
                        <p><a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ $attachment->type }}</a></p>
                    @endif
                @endforeach
            </div>
        @else
            <p>No hay archivos cargados.</p>
        @endif
      </div>
          <div class="glass-reload mt-4">
            <a href="{{ route('search') }}" class="btn-nueva-busqueda">🔄 Nueva búsqueda</a>
          </div>
    </div>
  @else
    <div class="glass-card mt-5" data-aos="fade-in">
      <h3>No se encontró ningún solicitante con esos datos.</h3>
    </div>
  @endif

</div>
@endif

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
    
</body>
</html>
