@extends('layouts.sidebar')

@section('content')

<div class="row">
  <!-- Usuarios -->
  <div class="col-lg-3 col-md-6 mb-4">
    <div class="glass-box glass-usuarios" data-aos="fade-up">
      <div class="glass-inner">
        <div class="glass-content">
          <h2 class="glass-title">{{ count($users) }}</h2>
          <p class="glass-subtitle">Usuarios</p>
        </div>
        <div class="glass-icon">
          <i class="fas fa-users"></i>
        </div>
      </div>
      <a href="{{ route('sys.users.index') }}" class="glass-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Licencias -->
  <div class="col-lg-3 col-md-6 mb-4">
    <div class="glass-box glass-licencias" data-aos="fade-up" data-aos-delay="100">
      <div class="glass-inner">
        <div class="glass-content">
          <h2 class="glass-title">0</h2>
          <p class="glass-subtitle">Licencias</p>
        </div>
        <div class="glass-icon">
          <i class="fas fa-id-card"></i>
        </div>
      </div>
      <a href="#" class="glass-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Consultas -->
  <div class="col-lg-3 col-md-6 mb-4">
    <div class="glass-box glass-consultas" data-aos="fade-up" data-aos-delay="200">
      <div class="glass-inner">
        <div class="glass-content">
          <h2 class="glass-title">0</h2>
          <p class="glass-subtitle">Consultas</p>
        </div>
        <div class="glass-icon">
          <i class="fas fa-search"></i>
        </div>
      </div>
      <a href="#" class="glass-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

 
@endsection