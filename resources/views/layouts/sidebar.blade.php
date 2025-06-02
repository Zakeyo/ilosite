@extends('layouts.navbar')
@section('nav-bar')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          {{-- <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div> --}}
          <div class="info">
            <a href="#" class="d-block"><b>{{ Auth::user()->name }}</b></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{-- <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Starter Pages
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Page</p>
                  </a>
                </li>
              </ul>
            </li> --}}

            <li class="nav-item">
              <a href="{{ route('sys') }}" class="nav-link {{ request()->routeIs('sys') ? 'active' : '' }}">
                <i class="nav-icon fas">
                  <i class="nav-icon fas fa-home"></i>
                </i>
                  <p>Menú principal</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('sys.applicants.index') }}" class="nav-link {{ request()->routeIs('sys.applicants.*') ? 'active' : '' }}">
                <i class="nav-icon fas">
                  <i class="nav-icon fas fa-users"></i>
                </i>
                  <p>Aplicantes</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('sys.users.index') }}" class="nav-link {{ request()->routeIs('sys.users.*') ? 'active' : '' }}">
                <i class="nav-icon fas">
                  <i class="bi bi-person-badge-fill"></i>
                </i>
                  <p>Usuarios</p>
              </a>
            </li>


            {{-- <li class="nav-item">
              <a href="{{ route('search') }}" class="nav-link" target="_blank">
                <i class="nav-icon fas">
                  <i class="fas fa-search fa-fw"></i>
                </i>
                <p>
                  Busqueda
                </p>
              </a>
            </li> --}}
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


  <!-- Content Wrapper. Contains page content -->
    <div class="wrapper d-flex flex-column min-vh-100">
      <div class="content-wrapper flex-grow-1 fondo-adminlte" style="padding: 15px">
        <div class="marco">
          @yield('content')
        </div>
      </div>
    </div>

  <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer custom-footer text-center text-sm-start">
      <div class="d-flex justify-content-between align-items-center flex-wrap">
        <!-- Lado izquierdo -->
        <div>
          <strong>
            &copy; 2025 <a href="{{ route('welcome') }}" class="footer-link">International Licence Official</a>.
          </strong>
          Todos los derechos reservados.
        </div>

        <!-- Lado derecho opcional -->
        <div class="d-none d-sm-inline text-muted">
          Sistema de gestión de licencias internacionales.
        </div>
      </div>
    </footer>

  </div>
  <!-- ./wrapper -->
@endsection