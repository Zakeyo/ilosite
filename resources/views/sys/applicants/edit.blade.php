@extends('layouts.sidebar')

@section('content')
<div class="container mt-4">
    <h2>Editar Solicitante</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay algunos problemas con la información.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sys.applicants.update', $applicant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Datos personales -->
        <div class="mb-3">
            <label>Nombres</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $applicant->first_name) }}" required>
        </div>

        <div class="mb-3">
            <label>Apellidos</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $applicant->last_name) }}" required>
        </div>

        <div class="mb-3">
            <label>Cédula / ID</label>
            <input type="text" name="id_number" class="form-control" value="{{ old('id_number', $applicant->id_number) }}" required>
        </div>

        <div class="mb-3">
            <label>Fecha de nacimiento</label>
            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', optional($applicant->birth_date)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $applicant->email) }}">
        </div>

        <div class="mb-3">
            <label>País de origen</label>
            <select name="country_of_origin" class="form-select" required>
                @foreach($countries as $country)
                    <option value="{{ $country }}" {{ old('country_of_origin', $applicant->country_of_origin) == $country ? 'selected' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Dirección 1</label>
            <input type="text" name="address_1" class="form-control" value="{{ old('address_1', $applicant->address_1) }}" required>
        </div>

        <div class="mb-3">
            <label>Dirección 2 (opcional)</label>
            <input type="text" name="address_2" class="form-control" value="{{ old('address_2', $applicant->address_2) }}">
        </div>

        <div class="mb-3">
            <label>Teléfono 1</label>
            <input type="text" name="phone_1" class="form-control" value="{{ old('phone_1', $applicant->phone_1) }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono 2 (opcional)</label>
            <input type="text" name="phone_2" class="form-control" value="{{ old('phone_2', $applicant->phone_2) }}">
        </div>

        <div class="mb-3">
            <label>Nº de pasaporte (opcional)</label>
            <input type="text" name="passport_number" class="form-control" value="{{ old('passport_number', $applicant->passport_number) }}">
        </div>

        <div class="mb-3">
            <label>Estatura (cm)</label>
            <input type="number" name="height_cm" class="form-control" value="{{ old('height_cm', $applicant->height_cm) }}" required min="50" max="300">
        </div>

        <div class="mb-3">
            <label>Color de ojos</label>
            <input type="text" name="eye_color" class="form-control" value="{{ old('eye_color', $applicant->eye_color) }}" required>
        </div>

        <div class="mb-3">
            <label>Tipo de sangre</label>
            <select name="blood_type" class="form-select" required>
                @foreach($bloodTypes as $type)
                    <option value="{{ $type }}" {{ old('blood_type', $applicant->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>¿Posee licencia en su país?</label>
            <select name="has_local_license" id="has_local_license" class="form-select" required>
                <option value="0" {{ old('has_local_license', $applicant->has_local_license) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('has_local_license', $applicant->has_local_license) == 1 ? 'selected' : '' }}>Sí</option>
            </select>
        </div>

        <div id="local_license_photos" style="{{ old('has_local_license', $applicant->has_local_license) == 1 ? '' : 'display: none;' }}">
            <div class="mb-3">
                <label>Imagen frontal de la licencia</label>
                @php
                    $localFront = $applicant->attachments->firstWhere('type', 'local_license_front');
                @endphp
                @if($localFront)
                    <div>
                        <a href="{{ Storage::url($localFront->file_path) }}" target="_blank">Archivo actual</a>
                    </div>
                @endif
                <input type="file" name="local_license_front" class="form-control">
            </div>
            <div class="mb-3">
                <label>Imagen trasera de la licencia</label>
                @php
                    $localBack = $applicant->attachments->firstWhere('type', 'local_license_back');
                @endphp
                @if($localBack)
                    <div>
                        <a href="{{ Storage::url($localBack->file_path) }}" target="_blank">Archivo actual</a>
                    </div>
                @endif
                <input type="file" name="local_license_back" class="form-control">
            </div>
        </div>


        {{-- Datos de la licencia que se va a generar --}}
<hr>
<h4>Datos de la licencia</h4>

<div class="mb-3">
    <label>Tipo de licencia</label>
    <select name="license_type" id="license_type" class="form-select" required>
        <option value="">Seleccione</option>
        <option value="DIGITAL" {{ old('license_type', $applicant->license->type ?? '') == 'DIGITAL' ? 'selected' : '' }}>Digital</option>
        <option value="FISICA" {{ old('license_type', $applicant->license->type ?? '') == 'FISICA' ? 'selected' : '' }}>Física</option>
    </select>
</div>

<div class="mb-3">
    <label>Duración</label>
    <select name="duration" id="duration" class="form-select" required>
        {{-- Se carga dinámicamente con JS --}}
    </select>
</div>

<div class="mb-3">
    <label>Categorías</label><br>
    @php
        $selectedCategories = old('categories', $applicant->license->categories ?? []);
        if (is_string($selectedCategories)) {
            $selectedCategories = explode(',', $selectedCategories);
        }
    @endphp
    @foreach(['A', 'B', 'C', 'D', 'E'] as $cat)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $cat }}" {{ in_array($cat, $selectedCategories) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $cat }}</label>
        </div>
    @endforeach
</div>

<div class="mb-3">
    <label>Número de transacción</label>
    <input type="text" name="transaction_number" class="form-control" value="{{ old('transaction_number', $applicant->license->transaction_number ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Imagen frontal de la licencia generada</label>
    @php
        $front = $applicant->license->attachments->firstWhere('type', 'license_front');
    @endphp
    @if($front)
        <div>
            <a href="{{ Storage::url($front->file_path) }}" target="_blank">Archivo actual</a>
        </div>
    @endif
    <input type="file" name="license_front" class="form-control">
</div>

<div class="mb-3">
    <label>Imagen trasera de la licencia generada</label>
    @php
        $back = $applicant->license->attachments->firstWhere('type', 'license_back');
    @endphp
    @if($back)
        <div>
            <a href="{{ Storage::url($back->file_path) }}" target="_blank">Archivo actual</a>
        </div>
    @endif
    <input type="file" name="license_back" class="form-control">
</div>

<div class="mb-3">
    <label>Archivos adicionales (opcional)</label>
    @php
        $extras = $applicant->license->attachments->where('type', 'extra');
    @endphp
    @if($extras && $extras->count() > 0)
        <div>
            <ul>
                @foreach($extras as $extra)
                    <li><a href="{{ Storage::url($extra->file_path) }}" target="_blank">Archivo {{ $loop->iteration }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="file" name="extras[]" multiple class="form-control">
</div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hasLicense = document.getElementById('has_local_license');
        const licensePhotos = document.getElementById('local_license_photos');
        const licenseType = document.getElementById('license_type');
        const duration = document.getElementById('duration');
        const selectedDuration = @json(old('duration', $applicant->license->duration ?? ''));

        // Mostrar u ocultar imágenes de licencia local según selección
        function toggleLicensePhotos() {
            licensePhotos.style.display = hasLicense.value == '1' ? 'block' : 'none';
        }

        hasLicense.addEventListener('change', toggleLicensePhotos);
        toggleLicensePhotos(); // Ejecutar al cargar por si ya está seleccionado

        // Actualizar opciones de duración según tipo
        function updateDurations() {
            const type = licenseType.value;
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

            // Seleccionar duración si ya hay una guardada
            if (selectedDuration) {
                const opt = duration.querySelector(`option[value="${selectedDuration}"]`);
                if (opt) {
                    opt.selected = true;
                }
            }
        }

        licenseType.addEventListener('change', updateDurations);
        updateDurations(); // Ejecutar al cargar
    });
</script>
@endsection
