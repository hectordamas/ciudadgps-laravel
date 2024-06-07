@extends('layouts.public')
@section('title')
<title>Editar Categoria - CiudadGPS</title>
@endsection
@section('content')
<div class="section py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Editar Categoría
                </div>
                <form action="{{ url('locales-asociados/categories/'. $pcategory->id . '/update' )  }}" method="POST" class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Nombre de la Categoría</label>
                            <input type="text" required class="form-control" name="name" value="{{$pcategory->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-line">Modificar Información</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection