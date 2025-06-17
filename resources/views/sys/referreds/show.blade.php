@extends('layouts.sidebar')

@section('content')

<div class="glass-card">
    <h1 class="glass-title">Detalle del Referido</h1>

    <div class="glass-section">
        <ul class="glass-info">
            <li><strong>Nombre completo:</strong> {{ $referred->full_name }}</li>
            <li><strong>Teléfono 1:</strong> {{ $referred->phone1 }}</li>
            <li><strong>Teléfono 2:</strong> {{ $referred->phone2 ?? 'No registrado' }}</li>
            <li><strong>País:</strong> {{ $referred->country }}</li>
            <li><strong>Referido por:</strong> 
                {{ $referred->referredBy ? $referred->referredBy->full_name : 'Nadie' }}
            </li>
            <li><strong>Referidos por esta persona:</strong>
                @if($referred->referrals->count())
                    <ul>
                        @foreach($referred->referrals as $ref)
                            <li>{{ $ref->full_name }}</li>
                        @endforeach
                    </ul>
                @else
                    Ninguno
                @endif
            </li>
        </ul>
    </div>

    <a href="{{ route('sys.referreds.index') }}" class="btn-agregar mt-3">Volver al listado</a>
</div>

@endsection