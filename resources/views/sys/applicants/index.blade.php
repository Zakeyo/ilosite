@extends('layouts.sidebar')

@section('content')
    <h1>Listado de Solicitantes</h1>

    <a href="{{ route('sys.applicants.create') }}" class="btn btn-primary mb-3">Agregar Solicitante</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula / ID</th>
                <th>Licencia</th>
                <th>Duración</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($applicants as $applicant)
                <tr>
                    <td>{{ $applicant->first_name }}</td>
                    <td>{{ $applicant->last_name }}</td>
                    <td>{{ $applicant->id_number }}</td>
                    <td>{{ $applicant->license ? $applicant->license->license_type : 'Sin licencia' }}</td>
                    <td>{{ $applicant->license ? $applicant->license->duration : '-' }}</td>
                    <td>
                        @if ($applicant->license)
                            @php
                                $status = $applicant->license->status;
                                $color = match ($status) {
                                    'inactiva' => 'secondary',
                                    'activa' => 'success',
                                    'vencida' => 'danger',
                                    default => 'dark',
                                };
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ strtoupper($status) }}</span>
                        @else
                            <span class="badge bg-secondary">Sin licencia</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('sys.applicants.show', $applicant->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('sys.applicants.edit', $applicant->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('sys.applicants.destroy', $applicant->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este solicitante?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay solicitantes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $applicants->links() }} <!-- Paginación -->
@endsection
