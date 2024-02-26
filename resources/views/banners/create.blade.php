@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Crear Anuncio
            </div>
            <div class="card-body">
                <form action="{{ route('banners.store') }}" method="post" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4 form-group">
                        <label for="banner" class="text-dark font-weight-bold">Cargar Banner *:</label>
                        <input type="file" name="banner" id="banner" accept="images/*" class="form-control" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="url" class="text-dark font-weight-bold">Enlace:</label>
                        <input type="text" name="url" id="url" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="commerce_id" class="text-dark font-weight-bold">ID Comercio:</label>
                        <input type="text" name="commerce_id" id="commerce_id" class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="section" class="text-dark font-weight-bold">Sección:</label>
                        <select name="section" id="section" class="form-control">
                            <option value="Sección 1">Sección 1</option>                            
                            <option value="Sección 2">Sección 2</option>
                            <option value="Sección 3">Sección 3</option>
                            <option value="Sección 4">Sección 4</option>
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="hide" class="text-dark font-weight-bold">Ocultar:</label>
                        <select name="hide" id="hide" class="form-control">
                            <option value="No">No</option>                            
                            <option value="Sí">Sí</option>
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición:</label>
                        <input type="text" name="position" id="position" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-bullhorn"></i> Crear Anuncio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection