@extends('layouts.public')
@section('content')
<div class="container py-5">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 col-md-10 order-lg-first">
            <div class="text-center">
                <div class="error_txt">500</div>
                <h5 class="mb-2 mb-sm-3">Ha ocurrido un error!</h5> 
                <p>Ha ocurrido un error interno, por favor intente esta consulta luego.</p>
                <a href="{{ url('/') }}" class="btn btn-fill-out">Volver a la página de inicio</a>
            </div>
        </div>
    </div>
</div>
@endsection