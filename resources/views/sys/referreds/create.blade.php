@extends('layouts.sidebar')

@section('content')

<form method="POST" action="{{ route('sys.referreds.store') }}">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="first_name" required>

    <label>Apellido:</label>
    <input type="text" name="last_name" required>

    <label>Teléfono 1:</label>
    <input type="text" name="phone1" required>

    <label>Teléfono 2 (opcional):</label>
    <input type="text" name="phone2">

    <label>Referido por:</label>
    <select name="referred_by_id">
        <option value="">Nadie</option>
        @foreach($referreds as $ref)
            <option value="{{ $ref->id }}">{{ $ref->first_name }} {{ $ref->last_name }}</option>
        @endforeach
    </select>

    <label>País:</label>
    <input type="text" name="country" required>

    <button type="submit">Guardar</button>
</form>


@endsection