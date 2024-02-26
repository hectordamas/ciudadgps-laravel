@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Editar Categoría
            </div>
            <div class="card-body">
                <form action="{{route('category.update', ['category' => $category->id])}}" method="post" class="row" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="col-md-3 form-group">
                        <label for="name" class="text-dark font-weight-bold">Categoría:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="image" class="text-dark font-weight-bold">Cargar ícono:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición:</label>
                        <input type="number" class="form-control" id="position" name="position" value="{{$category->position}}">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="hidden" class="text-dark font-weight-bold">Ocultar</label>
                        <select name="hidden" id="hidden" class="form-control">
                            <option value="{{$category->hidden ? 'Sí' : '' }}">{{$category->hidden ? 'Sí' : 'No' }}</option>
                            <option value="">No</option>
                            <option value="Sí">Sí</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Crear Categoría">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection