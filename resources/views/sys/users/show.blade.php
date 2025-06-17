@extends('layouts.sidebar')
@section('content')

<div class="glass-card">
  <h1 class="glass-title">Detalles del Usuario</h1>

  <div class="glass-section">
    <ul class="glass-info">
      <li><strong>ID:</strong> {{ $user->id }}</li>
      <li><strong>Nombre:</strong> {{ $user->name }}</li>
      <li><strong>Email:</strong> {{ $user->email }}</li>
      <li><strong>Creado:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</li>
    </ul>
  </div>

  <a href="{{ route('sys.users.index') }}" class="btn-back">← Volver</a>
</div>

@endsection
