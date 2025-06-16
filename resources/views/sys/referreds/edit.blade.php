@extends('layouts.sidebar')

@section('content')

<div class="container">
    <h1>Editar Referido</h1>

    <form action="{{ route('sys.referreds.update', $referred) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $referred->first_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Apellido</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $referred->last_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone1" class="form-label">Teléfono 1</label>
            <input type="text" name="phone1" class="form-control" value="{{ old('phone1', $referred->phone1) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone2" class="form-label">Teléfono 2</label>
            <input type="text" name="phone2" class="form-control" value="{{ old('phone2', $referred->phone2) }}">
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" name="country" class="form-control" value="{{ old('country', $referred->country) }}" required>
        </div>

        <div class="mb-3">
            <label for="referred_by_id" class="form-label">Referido por</label>
            <select name="referred_by_id" class="form-select">
                <option value="">Nadie</option>
                @foreach($referredOptions as $id => $name)
                    <option value="{{ $id }}" {{ (old('referred_by_id', $referred->referred_by_id) == $id) ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('sys.referreds.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection