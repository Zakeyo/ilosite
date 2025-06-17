@extends('layouts.sidebar')

@section('content')

<div class="glass-card">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <h1 class="glass-title">Listado de Referidos</h1>

    <a href="{{ route('sys.referreds.create') }}" class="btn-agregar mb-3">+ Agregar Referido</a>

<div class="glass-section mt-3">
<div class="table-responsive">
    <table class="glass-table">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Teléfono 1</th>
                <th>Teléfono 2</th>
                <th>Referido por</th>
                <th>País</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($referreds as $referred)
                <tr>
                    <td>{{ $referred->full_name }}</td>
                    <td>{{ $referred->phone1 }}</td>
                    <td>{{ $referred->phone2 ?? '-' }}</td>
                    <td>
                        {{ $referred->referredBy ? $referred->referredBy->full_name : 'Nadie' }}
                    </td>
                    <td>{{ $referred->country }}</td>
                    <td>
                        <a href="{{ route('sys.referreds.show', $referred) }}" class="btn-accion btn-ver">Ver</a>
                        <a href="{{ route('sys.referreds.edit', $referred) }}" class="btn-accion btn-editar">Editar</a>

                        <form action="{{ route('sys.referreds.destroy', $referred) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar este referido?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-accion btn-eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay referidos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
    {{ $referreds->links() }}
</div>

@endsection