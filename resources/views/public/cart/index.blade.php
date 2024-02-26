@extends('layouts.public')
@section('title')
<title>CiudadGPS - Carrito de Compras</title>
@endsection
@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/cart.jpg') }}'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light">Carrito de Compras</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Carrito de Compras</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-12">
                @if(Cart::name('shopping')->countItems() > 0)
                <div class="table-responsive shop_cart_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Producto</th>
                                <th class="product-price">Precio</th>
                                <th class="product-quantity">Cantidad</th>
                                <th class="product-remove">Eliminar</th>
                                <th class="product-edit">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Cart::name('shopping')->getItems() as $item)
                            @php
                                $item = $item->getDetails();
                            @endphp
                        	<tr data-id="{{$item->id}}" data-hash="{{$item->hash}}" id="tr{{$item->hash}}">
                                <input type="hidden" id="qty-input{{$item->hash}}" value="{{$item->quantity}}">
                            	<td class="product-thumbnail"><a href="#">@isset($item->options['img'])<img src="{{$item->options['img']}}" alt="{{$item->title}}" width="80px" height="80px" style="object-fit: cover;">@endisset</a></td>
                                <td class="product-name" data-title="Producto"><a href="#">{{$item->title}}</a></td>
                                <td class="product-price" data-title="Precio">${{number_format($item->price, 2, '.', ',')}}</td>
                                <td class="product-quantity product-quantity-{{$item->hash}}" data-title="Cantidad">{{$item->quantity}}</td>
                                <td class="product-remove" data-title="Eliminar"><a href="javascript:void(0);" class="deleteCartItem" data-hash="{{$item->hash}}"><i class="ti-close"></i></a></td>
                                <td class="product-edit" data-title="Editar">
                                    <a href="javascript:void(0);" class="btn btn-fill-out updateCartItem" data-hash="{{$item->hash}}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h4 class="py-5">Aún no has agregado ningún producto a tu carrito de compras</h4>
                @endif
            </div>
        </div>
        @if(Cart::name('shopping')->countItems() > 0)
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            	<div class="border p-3 p-md-4">
                    <div class="heading_s1 mb-3">
                        <h6>Totales</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_subtotal_label">Subtotal</td>
                                    <td class="cart_subtotal_amount">${{ number_format(Cart::name('shopping')->getSubtotal(), 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">Total</td>
                                    <td class="cart_total_amount"><strong>${{ number_format(Cart::name('shopping')->getSubtotal(), 2, '.', ',') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ url('/checkout') }}" class="btn btn-fill-out">Procesar Orden</a>
                    @php
                        $commerceId = Session::get('commerceId');
                    @endphp

                    
                    <a onclick="history.back()" href="javascript:void(0)" class="btn btn-dark">
                        <i class="fas fa-arrow-left" style="font-size:22px;"></i>  Volver
                    </a>

                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- END SECTION SHOP -->
@endsection