@extends('layouts.sidebar')

@section('content')
<div class="glass-card">
  <h1 class="glass-title">📋 Listado de Solicitantes</h1>

  <a href="{{ route('sys.applicants.create') }}" class="btn-agregar mb-3">+ Agregar Solicitante</a>

  <div class="table-responsive">
    <table class="glass-table">
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
                      'inactiva' => 'badge-secondary',
                      'activa' => 'badge-success',
                      'vencida' => 'badge-danger',
                      default => 'badge-dark',
                  };
                @endphp
                <span class="badge-custom {{ $color }}">{{ strtoupper($status) }}</span>
              @else
                <span class="badge-custom badge-secondary">Sin licencia</span>
              @endif
            </td>
            <td class="acciones">
              <a href="{{ route('sys.applicants.show', $applicant->id) }}" class="btn-accion btn-ver">Ver</a>
              <a href="{{ route('sys.applicants.edit', $applicant->id) }}" class="btn-accion btn-editar">Editar</a>
              <form action="{{ route('sys.applicants.destroy', $applicant->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este solicitante?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-accion btn-eliminar">Eliminar</button>
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
  </div>

  {{ $applicants->links() }}<!-- Paginación -->
</div>
@endsection
