@extends('layouts.sidebar')

@section('content')
<div class="glass-form-container">
  <h2 class="glass-title">Crear Nuevo Usuario</h2>

  <form method="POST" action="{{ route('sys.users.store') }}" class="glass-form">
    @csrf

<div class="glass-section">

  <div class="form-row">

    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" required>
    </div>

    <div class="form-group">
      <label for="email">Correo electrónico</label>
      <input type="email" name="email" id="email" required>
    </div>
  </div>
  
  <label for="password">Contraseña</label>
  <input type="password" name="password" id="password" required>
  
</div>
    <div class="container my-4">
          <div class="row justify-content-center">
              <div class="col-auto">
                  <button type="submit" class="btn btn-success">
                      <i class="fas fa-save me-1"></i> Crear usuario
                  </button>
              </div>
    
              <div class="col-auto">
                  <a href="{{ route('sys.referreds.index') }}" class="btn btn-secondary">
                      <i class="fas fa-times me-1"></i> Cancelar
                  </a>
              </div>
          </div>
      </div>
  </form>
</div>


  {{-- <a class="btn-back" href="{{ route('sys.users.index') }}">← Volver a la lista</a> --}}

@endsection