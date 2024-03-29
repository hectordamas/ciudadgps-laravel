@extends('layouts.public')
@section('title')
<title>CiudadGPS - Catálogo de Productos</title>
@endsection
@section('content')
<style>
    html{
        overflow-x: hidden;
    }
    #tooltipContainer {
      position: absolute;
      bottom: -35px;
      background-color: #000;
      color: #fff;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 14px;
      z-index: 9999;
    }
</style>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/job_background.jpg') }}'); background-position: center center; background-size: cover; position: relative;">

</div>
<!-- END SECTION BREADCRUMB -->

<div class="section">

    <div class="row justify-content-center" style="margin-top: -80px;">
        <div class="col-md-10 d-flex justify-content-center my-2">
            <img class="border rounded-circle" style="width: 120px; height: 120px;" src="{{ asset($commerce->logo) }}" alt="{{$commerce->name}}">
        </div>

        <div class="col-md-10 d-flex justify-content-center my-2">
            <h3 class="text-center">{{$commerce->name}}</h3>
        </div>

        <div class="col-md-10 d-flex justify-content-center mb-5">
            <a href="{{ url('/carrito-de-compras') }}" class="btn btn-sm btn-light" style="background: #e9e9e9;"> 
                <i class="icon-basket-loaded" style="font-size: 20px;"></i>
                Ir al Carrito
            </a>
            <a href="javascript:void(0)" id="copyButton" class="btn btn-sm btn-light" style="background: #e9e9e9;"> 
                <i class="far fa-copy" style="font-size: 20px;"></i>
                Copiar Enlace
                <div id="tooltipContainer" style="display: none;"></div>
            </a>
        </div>

        <div class="col-md-8">
            <div class="row shop_container justify-content-center">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-5 col-5 grid_item px-2">
                    <div class="product shadow product_box border-0">
                        <div class="product_img" style="aspect-ratio: 1;">
                            <a href="/productos/{{ $product->id }}" style="position: relative; height: 100%;">
                                <img src="{{ asset($product->image) }}" style="object-fit: cover; height: 100%; aspect-ratio: 1;" alt="{{ $product->name }}">
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-sm addToCart" data-commerce="{{$product->commerce_id}}" data-id="{{$product->id}}" style="background-color: rgba(0,0,0,0.5); position: absolute; top: 0; right: 0; border-radius: 0;">
                                <i class="icon-basket-loaded text-light" style="font-size: 30px;"></i>
                            </a>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title"><a href="/productos/{{ $product->id }}">{{$product->name}}</a></h6>
                            <div class="product_price">
                                <span class="price">${{ number_format($product->price, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

@section('map')
<script>
$(document).ready(function() {
  $('#copyButton').click(function() {
    var link = window.location.href;
    var tempInput = $('<input>');
    $('body').append(tempInput);
    tempInput.val(link).select();
    document.execCommand('copy');
    tempInput.remove();

    // Muestra el tooltip de confirmación
    var tooltipContainer = $('#tooltipContainer');
    tooltipContainer.text('Enlace copiado');
    tooltipContainer.fadeIn();

    // Oculta el tooltip después de 2 segundos
    setTimeout(function() {
      tooltipContainer.fadeOut();
    }, 2000);
  });
});
</script>
@endsection
