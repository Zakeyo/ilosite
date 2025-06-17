@extends('layouts.sidebar')

@section('content')
<div class="glass-card">
  <h1 class="glass-title">🧾 Detalles del Solicitante</h1>

  <!-- Sección datos personales -->
  <div class="glass-section">
    <h3 class="glass-section-title">Información personal</h3>
    <ul class="glass-info">
      <li><strong>Nombre completo:</strong> {{ $applicant->first_name }} {{ $applicant->last_name }}</li>
      <li><strong>Cédula / ID:</strong> {{ $applicant->id_number }}</li>
      <li><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($applicant->birth_date)->format('d/m/Y') }}</li>
      <li><strong>Email:</strong> {{ $applicant->email ?? 'No especificado' }}</li>
      <li><strong>País de origen:</strong> {{ $applicant->country_of_origin }}</li>
      <li><strong>Dirección 1:</strong> {{ $applicant->address_1 }}</li>
      <li><strong>Dirección 2:</strong> {{ $applicant->address_2 ?? 'No especificada' }}</li>
      <li><strong>Teléfono 1:</strong> {{ $applicant->phone_1 }}</li>
      <li><strong>Teléfono 2:</strong> {{ $applicant->phone_2 ?? 'No especificado' }}</li>
      <li><strong>Nº Pasaporte:</strong> {{ $applicant->passport_number ?? 'No especificado' }}</li>
      <li><strong>Estatura (cm):</strong> {{ $applicant->height_cm }}</li>
      <li><strong>Color de ojos:</strong> {{ $applicant->eye_color }}</li>
      <li><strong>Tipo de sangre:</strong> {{ $applicant->blood_type }}</li>
      <li><strong>Posee licencia local:</strong> {{ $applicant->has_local_license ? 'Sí' : 'No' }}</li>
    </ul>
  </div>

  <!-- Sección licencia -->
  <div class="glass-section">
    <h3 class="glass-section-title">Licencia</h3>
    @if($applicant->license)
      <ul class="glass-info">
        <li><strong>Tipo:</strong> {{ $applicant->license->license_type }}</li>
        <li><strong>Duración:</strong> {{ $applicant->license->duration }}</li>
        <li><strong>Categorías:</strong> {{ implode(', ', $applicant->license->categories) }}</li>
        {{-- <li><strong>Número de trámite:</strong> {{ $applicant->license->transaction_number }}</li> --}}
        <li><strong>Fecha de emisión:</strong> {{ $applicant->license->issued_at?->format('d/m/Y') ?? 'No emitida' }}</li>
        <li><strong>Fecha de expiración:</strong> {{ $applicant->license->expires_at?->format('d/m/Y') ?? 'No establecida' }}</li>
        <li><strong>Estado:</strong> {{ ucfirst($applicant->license->status) }}</li>
      </ul>
    @else
      <p>No tiene licencia asociada.</p>
    @endif
  </div>

  <!-- Sección archivos -->
  <div class="glass-section">
    <h3 class="glass-section-title">Archivos adjuntos</h3>
    @if($applicant->attachments->count() > 0)
      <ul class="glass-files">
        @foreach($applicant->attachments as $attachment)
          <li>
            <strong>{{ ucfirst(str_replace('_', ' ', $attachment->type)) }}:</strong>
            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">Ver archivo</a>
          </li>
        @endforeach
      </ul>
    @else
      <p>No hay archivos adjuntos.</p>
    @endif
  </div>

  <a href="{{ route('sys.applicants.index') }}" class="btn-volver">← Volver a la lista</a>
</div>

@endsection
