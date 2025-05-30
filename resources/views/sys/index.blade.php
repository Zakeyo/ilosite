@extends('layouts.sidebar')

@section('content')

    <div class="col-lg-3">
        <h1>Menú principal</h1>

        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ count($users) }}</h3>
                <p>Ingresados</p>
            </div>
                <div class="icon">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>
            <a href="{{ route('sys.users.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
 
@endsection