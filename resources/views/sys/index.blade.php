@extends('layouts.sidebar')

@section('content')
    <h1>Bienvenido al Sistema</h1>

    <p>Hola, {{ $user->name }}</p>

    <div>
        <a class="btn" href="{{ route('sys.users.index') }}">Gestión de Usuarios</a>
        <a class="btn" href="{{ route('search') }}">Buscar Personas</a>
        <a class="btn" href="{{ route('welcome') }}">Ir a la Página Principal</a>
        
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn" style="background-color: #e3342f;">
                Cerrar Sesión
            </button>
        </form>
    </div>
@endsection