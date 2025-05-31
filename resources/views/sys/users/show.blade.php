@extends('layouts.sidebar')
@section('content')

<div class="glass-card">
  <h2>Detalle del Usuario</h2>

  <div class="info-user">
    <p><span class="label">🆔 ID:</span> {{ $user->id }}</p>
    <p><span class="label">👤 Nombre:</span> {{ $user->name }}</p>
    <p><span class="label">📧 Email:</span> {{ $user->email }}</p>
    <p><span class="label">📅 Creado:</span> {{ $user->created_at->format('d/m/Y H:i') }}</p>
  </div>

  <a href="{{ route('sys.users.index') }}" class="btn-back">← Volver</a>
</div>

@endsection
