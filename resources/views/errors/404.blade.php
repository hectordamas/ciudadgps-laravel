@extends('layouts.public')
@section('content')
<div class="container py-5">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 col-md-10 order-lg-first">
            <div class="text-center">
                <div class="error_txt">404</div>
                <h5 class="mb-2 mb-sm-3">La página que buscas no fue encontrada!</h5> 
                <p>Tal vez fue movida, renombrada o nunca existió.</p>
                <a href="{{ url('/') }}" class="btn btn-fill-out">Volver a la página de inicio</a>
            </div>
        </div>
    </div>
</div>
@endsection