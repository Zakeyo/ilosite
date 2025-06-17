@extends('layouts.sidebar')

@section('content')

<div class="glass-form-container">
  <h2 class="glass-title">Registrar nuevo referido</h2>

<form method="POST" action="{{ route('sys.referreds.store') }}" class="glass-form">
    @csrf

<div class="glass-section">
    <div class="form-row">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Apellido:</label>
            <input type="text" name="last_name"  class="form-control">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Teléfono 1:</label>
            <input type="text" name="phone1"  class="form-control">
        </div>

        <div class="form-group">
            <label>Teléfono 2 (opcional):</label>
            <input type="text" name="phone2" class="form-control">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>País:</label>
            <input type="text" name="country" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Referido por:</label>
            <select name="referred_by_id" class="form-select">
                <option value="">Nadie</option>
                @foreach($referreds as $ref)
                    <option value="{{ $ref->id }}">{{ $ref->first_name }} {{ $ref->last_name }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-auto">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Crear referido
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

@endsection