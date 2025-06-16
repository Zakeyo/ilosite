@extends('layouts.sidebar')

@section('content')

<div class="container">
    <h1>Detalle del Referido</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre completo:</strong> {{ $referred->full_name }}</p>
            <p><strong>Teléfono 1:</strong> {{ $referred->phone1 }}</p>
            <p><strong>Teléfono 2:</strong> {{ $referred->phone2 ?? 'No registrado' }}</p>
            <p><strong>País:</strong> {{ $referred->country }}</p>
            <p><strong>Referido por:</strong> 
                {{ $referred->referredBy ? $referred->referredBy->full_name : 'Nadie' }}
            </p>
            <p><strong>Referidos por esta persona:</strong>
                @if($referred->referrals->count())
                    <ul>
                        @foreach($referred->referrals as $ref)
                            <li>{{ $ref->full_name }}</li>
                        @endforeach
                    </ul>
                @else
                    Ninguno
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('sys.referreds.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</div>

@endsection