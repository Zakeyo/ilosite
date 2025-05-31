@extends('layouts.head-scripts')
@section('head-scripts')
  <div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-control-total d-flex justify-content-between">

  <!-- Botón hamburguesa alineado a la izquierda -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="#" class="nav-link" data-widget="pushmenu" aria-label="Abrir menú">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- Contenedor derecho: botones y dropdown -->
  <div class="d-flex align-items-center">

    <!-- Botones visibles solo en escritorio -->
    <div class="botones-navbar d-none d-md-flex align-items-center gap-2">
      <a href="{{ route('welcome') }}" class="btn-navbar">Pantalla Principal</a>
      <a href="{{ route('search') }}" class="btn-navbar" target="_blank">
        <i class="fas fa-search fa-fw"></i> Búsqueda
      </a>
      <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn-cerrar-sesion">Cerrar Sesión</button>
      </form>
    </div>

    <!-- Dropdown en móviles -->
    <div class="dropdown d-md-none ms-2">
      <button class="btn-navbar dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Menú
      </button>
      <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
        <li><a class="dropdown-item" href="{{ route('welcome') }}">Pantalla Principal</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}" target="_blank">Búsqueda</a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item text-danger">Cerrar Sesión</button>
          </form>
        </li>
      </ul>
    </div>

  </div>
</nav>


      <!------------------------------------ BUSCADOR (LUPA) ------------------------------------>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

      <!------------------------------------ MENÚ NOTIFICACIONES ------------------------------------>
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}

      <!------------------------------------ EXPANDIR PANTALLA ------------------------------------>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}

      <!------------------------------------ CONTENIDO SIDEBAR DERECHO ------------------------------------>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}

  <!-- /.navbar -->

  @yield('nav-bar')
  
@endsection