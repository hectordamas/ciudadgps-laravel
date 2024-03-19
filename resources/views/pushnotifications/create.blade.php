@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Crear Nueva Notificacion
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pushnotifications.store') }}" class="row" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12 form-group">
                        <label for="" class="font-weight-bold">Titulo de la Notificacion</label>
                        <input type="text" name="title" required class="form-control" placeholder="Titulo">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="" class="font-weight-bold">Mensaje de la Notificacion</label>
                        <textarea name="message" required id="message" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark">Crear Nueva Notificacion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
