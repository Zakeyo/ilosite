@extends('layouts.sidebar')
@section('content')

<div class="glass-form-container">
  <h2 class="glass-title">Editar Usuario</h2>

    <form action="{{ route('sys.users.update', $user->id) }}" method="POST" class="glass-form">
    @csrf
    @method('PUT')

  <div class="glass-section">
  
    <div class="form-row">
      <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
      </div>
      
      <div class="form-group">
        <label for="email">Correo:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
      </div>

    </div>  

      <div class="form-group">
        <label for="password">Nueva Contraseña (opcional):</label>
        <input type="password" name="password" class="form-control">
      </div>
  
  </div>

        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Actualizar
                    </button>
                </div>

                <div class="col-auto">
                    <a href="{{ route('sys.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </div>
        </div>
  </form>
</div>



@endsection