@extends('layouts.sidebar')

@section('content')
    <h1>Bienvenido {{ $user->name }}</h1>

    <div>
        <a class="btn" href="{{ route('sys.users.index') }}">Gestión de Usuarios</a>
        <a class="btn" href="{{ route('search') }}">Buscar Personas</a>
        <a class="btn" href="{{ route('welcome') }}">Ir a la Página Principal</a>
        
        {{-- lo coloque en el nav bar del admin lte --}}
        {{-- <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn" style="background-color: #e3342f;">
                Cerrar Sesión
            </button>
        </form> --}}
    </div>
@endsection