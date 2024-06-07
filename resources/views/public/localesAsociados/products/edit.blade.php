@extends('layouts.public')
@section('title')
<title>Modificar datos del Producto - CiudadGPS</title>
@endsection
@section('content')
@php
    $filteredPcategories = $product->commerce->pcategories->filter(function ($pcategory) use ($product) {
        if (isset($product->pcategory)) {
            return $pcategory->id !== $product->pcategory->id;
        } else {
            return true; // Incluir todas las categorías si $product->pcategory no está definido
        }
    });
@endphp
<div class="section py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Modificar Datos del Producto
                </div>
                <div class="card-body">
                    <form action="{{ url('locales-asociados/productos/'. $product->id .'/update')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="text-info">Nombre del Producto</label>
                            <input type="text" class="form-control" required name="name" value="{{ $product->name }}">
                        </div>
    
                        <div class="form-group">
                            <label for="image" class="text-info">Imagen del Producto</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
    
                        <div class="form-group">
                            <label for="pcategory_id" class="text-info">Selecciona una Categoria</label>
                            <select name="pcategory_id" id="pcategory_id" class="form-control">
                                @if(isset($product->pcategory))
                                    <option value="{{ $product->pcategory->id }}">{{$product->pcategory->name }}</option>                                    
                                @else
                                    <option value="">Selecciona una Categoria</option>                                    
                                @endif

                                @foreach($filteredPcategories as $pcategory)
                                    <option value="{{ $pcategory->id }}">{{ $pcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="description" class="text-info">Descripción</label>
                            <input type="text" class="form-control" required name="description" value="{{ $product->description }}">
                        </div>
    
                        <div class="form-group">
                            <label for="price" class="text-info">Precio</label>
                            <input type="number" step="any" min="1" class="form-control" name="price" id="price" value="{{ $product->price }}" required>
                            <strong class="text-success" id="priceFormated">${{ number_format($product->price, 2, '.', ',') }}</strong>
                        </div>
    
    
                        <button class="btn btn-fill-line">Modificar Producto</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('map')
<script>
    $(document).ready(function() {
        $('#price').on('input', function(){
            let price = $('#price').val()

            let priceFormated = new Intl.NumberFormat("es-ES", {
                style: "currency",
                currency: "USD",
            }).format(price)

            $('#priceFormated').html(priceFormated)
        })
    })
</script>
@endsection