@extends('layouts.sidebar')

@section('content')
<h1>Detalles del Solicitante</h1>

<p><strong>Nombre completo:</strong> {{ $applicant->first_name }} {{ $applicant->last_name }}</p>
<p><strong>Cédula / ID:</strong> {{ $applicant->id_number }}</p>
<p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($applicant->birth_date)->format('d/m/Y') }}</p>
<p><strong>Email:</strong> {{ $applicant->email ?? 'No especificado' }}</p>
<p><strong>País de origen:</strong> {{ $applicant->country_of_origin }}</p>
<p><strong>Dirección 1:</strong> {{ $applicant->address_1 }}</p>
<p><strong>Dirección 2:</strong> {{ $applicant->address_2 ?? 'No especificada' }}</p>
<p><strong>Teléfono 1:</strong> {{ $applicant->phone_1 }}</p>
<p><strong>Teléfono 2:</strong> {{ $applicant->phone_2 ?? 'No especificado' }}</p>
<p><strong>Nº Pasaporte:</strong> {{ $applicant->passport_number ?? 'No especificado' }}</p>
<p><strong>Estatura (cm):</strong> {{ $applicant->height_cm }}</p>
<p><strong>Color de ojos:</strong> {{ $applicant->eye_color }}</p>
<p><strong>Tipo de sangre:</strong> {{ $applicant->blood_type }}</p>
<p><strong>Posee licencia local:</strong> {{ $applicant->has_local_license ? 'Sí' : 'No' }}</p>

<h2>Licencia</h2>
@if($applicant->license)
    <p><strong>Tipo:</strong> {{ $applicant->license->license_type }}</p>
    <p><strong>Duración:</strong> {{ $applicant->license->duration }}</p>
    <p><strong>Categorías:</strong> {{ implode(', ', $applicant->license->categories) }}</p>
    <p><strong>Número de trámite:</strong> {{ $applicant->license->transaction_number }}</p>
    <p><strong>Fecha de emisión:</strong> {{ $applicant->license->issued_at?->format('d/m/Y') ?? 'No emitida' }}</p>
    <p><strong>Fecha de expiración:</strong> {{ $applicant->license->expires_at?->format('d/m/Y') ?? 'No establecida' }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($applicant->license->status) }}</p>
@else
    <p>No tiene licencia asociada.</p>
@endif

<h2>Archivos adjuntos</h2>
@if($applicant->attachments->count() > 0)
    <ul>
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

<a href="{{ route('sys.applicants.index') }}">Volver a la lista</a>
@endsection
