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

    <div class="form-row">  
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Cédula o ID</label>
            <input type="text" name="id_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Fecha de nacimiento</label>
            <input type="date" name="birth_date" class="form-control" required>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        @php
            $countries = config('countries');
        @endphp

        <div class="form-group">
            <label>País de origen</label>
            <select name="country_of_origin" class="form-select" required>
                <option value="" disabled selected>Seleccione un país</option>
                @foreach($countries as $code => $country)
                    @php
                        // Genera el emoji de bandera (versión mejorada)
                        $emoji = mb_convert_encoding(
                            '&#' . (127397 + ord($code[0])) . ';' . 
                            '&#' . (127397 + ord($code[1])) . ';',
                            'UTF-8',
                            'HTML-ENTITIES'
                        );
                    @endphp
                    <option value="{{ $code }}">{!! $emoji !!} {{ $country }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Dirección 1</label>
            <input type="text" name="address_1" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Dirección 2 (opcional)</label>
            <input type="text" name="address_2" class="form-control">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Teléfono 1</label>
            <input type="text" name="phone_1" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Teléfono 2 (opcional)</label>
            <input type="text" name="phone_2" class="form-control">
        </div>
    </div>

    
    <div class="form-row">
        <div class="form-group">
            <label for="gender" class="form-label">Sexo</label>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Selecciona sexo</option>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Femenino</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Número de pasaporte</label>
            <input type="text" name="passport_number" class="form-control">
        </div>
    </div>

    <div class="mb-3">
            <label for="referred_id" class="form-label">Referido por</label>
            <select name="referred_id" class="form-select">
                <option value="">Nadie</option>
                @foreach($referreds as $referred)
                    <option value="{{ $referred->id }}" {{ old('referred_id') == $referred->id ? 'selected' : '' }}>
                        {{ $referred->first_name }} {{ $referred->last_name }}
                    </option>
                @endforeach
            </select>
            @error('referred_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Altura (cm)</label>
            <input type="number" name="height_cm" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Color de ojos</label>
            <input type="text" name="eye_color" class="form-control" required>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Tipo de sangre</label>
            <select name="blood_type" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        
        {{-- Foto tipo carnet --}}
        <div class="form-group">
            <label>Foto tipo carnet</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
        </div>
    </div>

        <div class="form-group">
            <label>¿Posee licencia en su país?</label>
            <select name="has_local_license" id="has_local_license" class="form-select" required>
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>
        </div>

        {{-- Archivos de licencia local si posee --}}
        <div id="local_license_photos" class="form-row" style="display: none;">
            <div class="form-group">
                <label>Imagen frontal de la licencia</label>
                <input type="file" name="local_license_front" class="form-control">
            </div>
            <div class="form-group">
                <label>Imagen trasera de la licencia</label>
                <input type="file" name="local_license_back" class="form-control">
            </div>
        </div>
</div>

    <div class="glass-section">
      <h3 class="glass-section-title">Datos de la licencia</h3>

        {{-- Datos de la licencia que se va a generar --}}
    <div class="form-row">
        <div class="form-group">
            <label>Tipo de licencia</label>
            <select name="license_type" id="license_type" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="DIGITAL">Digital</option>
                <option value="FISICA">Física</option>
            </select>
        </div>

        <div class="form-group">
            <label>Duración (seleccionar tipo de licencia)</label>
            <select name="duration" id="duration" class="form-select" required>
                {{-- Opciones dinámicas con JS --}}
            </select>
        </div>
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

    <div class="form-row">
        {{-- Imagen frontal y trasera de la licencia a entregar --}}
        <div class="form-group">
            <label>Imagen frontal de la licencia generada</label>
            <input type="file" name="license_front" class="form-control">
        </div>
        <div class="form-group">
            <label>Imagen trasera de la licencia generada</label>
            <input type="file" name="license_back" class="form-control">
        </div>
    </div>

    {{-- Botón para mostrar más archivos --}}
    <div class="form-group mt-2">
        <label>Archivos Adicionales</label>
        <button type="button" id="addExtraFileBtn" class="btn-agregar">➕ Agregar archivo adicional</button>
    </div>

    {{-- Contenedor oculto con los campos adicionales --}}
    <div id="extraFilesContainer">
        <div class="mb-3 extra-file d-none">
            <label for="extra_1" class="form-label">Archivo adicional 1</label>
            <input type="file" name="extra_1" id="extra_1" class="form-control">
        </div>

        <div class="mb-3 extra-file d-none">
            <label for="extra_2" class="form-label">Archivo adicional 2</label>
            <input type="file" name="extra_2" id="extra_2" class="form-control">
        </div>

        <div class="mb-3 extra-file d-none">
            <label for="extra_3" class="form-label">Archivo adicional 3</label>
            <input type="file" name="extra_3" id="extra_3" class="form-control">
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
        licensePhotos.style.display = this.value == '1' ? 'flex' : 'none';
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

{{-- js de boton para archivos adicionales --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('addExtraFileBtn');
    const extras = document.querySelectorAll('.extra-file');
    let index = 0;

    addBtn.addEventListener('click', () => {
      if (index < extras.length) {
        extras[index].classList.remove('d-none');
        index++;
      } else {
        addBtn.disabled = true;
        addBtn.innerText = "Has agregado el máximo de archivos.";
      }
    });
  });
</script>
@endsection
