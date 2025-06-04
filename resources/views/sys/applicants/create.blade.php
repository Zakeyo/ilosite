@extends('layouts.sidebar')

@section('content')
<div class="glass-form-container">
  <h2 class="glass-title">Registrar nuevo aplicante</h2>

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif


    <form action="{{ route('sys.applicants.store') }}" method="POST" enctype="multipart/form-data" class="glass-form">
        @csrf

        {{-- Seccion Informacion personal --}}
    <div class="glass-section">
      <h3 class="glass-section-title">Información personal</h3>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cédula o ID</label>
            <input type="text" name="id_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha de nacimiento</label>
            <input type="date" name="birth_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>País de origen</label>
            <select name="country_of_origin" class="form-select" required>
                @foreach($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Dirección 1</label>
            <input type="text" name="address_1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Dirección 2 (opcional)</label>
            <input type="text" name="address_2" class="form-control">
        </div>

        <div class="mb-3">
            <label>Teléfono 1</label>
            <input type="text" name="phone_1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono 2 (opcional)</label>
            <input type="text" name="phone_2" class="form-control">
        </div>

        <div class="mb-3">
            <label>Número de pasaporte</label>
            <input type="text" name="passport_number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Altura (cm)</label>
            <input type="number" name="height_cm" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Color de ojos</label>
            <input type="text" name="eye_color" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de sangre</label>
            <select name="blood_type" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>¿Posee licencia en su país?</label>
            <select name="has_local_license" id="has_local_license" class="form-select" required>
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>
        </div>

        {{-- Archivos de licencia local si posee --}}
        <div id="local_license_photos" style="display: none;">
            <div class="mb-3">
                <label>Imagen frontal de la licencia</label>
                <input type="file" name="local_license_front" class="form-control">
            </div>
            <div class="mb-3">
                <label>Imagen trasera de la licencia</label>
                <input type="file" name="local_license_back" class="form-control">
            </div>
        </div>
    </div>

    <div class="glass-section">
      <h3 class="glass-section-title">Datos de la licencia</h3>

        {{-- Datos de la licencia que se va a generar --}}

        <div class="mb-3">
            <label>Tipo de licencia</label>
            <select name="license_type" id="license_type" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="DIGITAL">Digital</option>
                <option value="FISICA">Física</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Duración</label>
            <select name="duration" id="duration" class="form-select" required>
                {{-- Opciones dinámicas con JS --}}
            </select>
        </div>

        <div class="mb-3">
            <label>Categorías</label><br>
            @foreach(['A', 'B', 'C', 'D', 'E'] as $cat)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $cat }}">
                    <label class="form-check-label">{{ $cat }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Número de transacción</label>
            <input type="text" name="transaction_number" class="form-control" required>
        </div>

        {{-- Imagen frontal y trasera de la licencia a entregar --}}
        <div class="mb-3">
            <label>Imagen frontal de la licencia generada</label>
            <input type="file" name="license_front" class="form-control">
        </div>
        <div class="mb-3">
            <label>Imagen trasera de la licencia generada</label>
            <input type="file" name="license_back" class="form-control">
        </div>

        {{-- Archivos adicionales --}}
        <div class="mb-3">
            <label>Archivos adicionales (opcional)</label>
            <input type="file" name="extras[]" multiple class="form-control">
        </div>
    </div>
        {{-- Botón final --}}
      <button type="submit" class="btn-submit-glass">Guardar</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hasLicense = document.getElementById('has_local_license');
    const licensePhotos = document.getElementById('local_license_photos');
    const licenseType = document.getElementById('license_type');
    const duration = document.getElementById('duration');

    hasLicense.addEventListener('change', function () {
        licensePhotos.style.display = this.value == '1' ? 'block' : 'none';
    });

    licenseType.addEventListener('change', function () {
        const type = this.value;
        let options = '';
        if (type === 'DIGITAL') {
            options = `
                <option value="3m">3 meses</option>
                <option value="6m">6 meses</option>
                <option value="1y">1 año</option>
                <option value="2y">2 años</option>
                <option value="5y">5 años</option>
            `;
        } else if (type === 'FISICA') {
            options = `
                <option value="1y">1 año</option>
                <option value="2y">2 años</option>
                <option value="5y">5 años</option>
            `;
        }
        duration.innerHTML = options;
    });
});
</script>
@endsection
