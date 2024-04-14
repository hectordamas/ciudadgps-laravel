@extends('layouts.public')
@section('title')
<title>CiudadGPS - Procesar Orden</title>
<meta name="description" content="Procesar orden en ciudadgps" />
<meta name="keywords" content="ciudadgps, orden, carrito de compras, pagon en linea">
@endsection

@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/checkout.jpg') }}'); background-position: center 60%; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center" style="height:10vh;">
        	<div class="col-md-8">
                <div class="page-title">
            		<h3 class="text-light text-capitalize">Procesar Orden</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light"><a href="/carrito-de-compras" class="text-light">Carrito de Compras</a></li>
                    <li class="breadcrumb-item text-light active">Procesar Orden</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START SECTION SHOP -->
<div class="section">
    @if(Cart::name('shopping')->countItems() > 0)
	<div class="container">
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
            	<div class="heading_s1">
            		<h4>Datos del Cliente</h4>
                </div>
                <form method="post">
                    <div class="form-group">
                        <input class="form-control" id="checkoutName" required type="text" name="name" placeholder="Nombre Y Apellido *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutCedula" required type="text" name="cedula" placeholder="Cédula / DNI *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutCel" required type="text" name="cel" placeholder="Celular / Whatsapp *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutAddress" required type="text"  name="address" placeholder="Dirección *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutCity" required type="text" name="city" placeholder="Ciudad *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutEmail" required type="text" name="email" placeholder="Correo Electrónico *">
                    </div>
                    <div class="heading_s1">
                        <h4>Información Adicional</h4>
                    </div>
                    <div class="form-group mb-0">
                        <textarea rows="5" class="form-control" id="checkoutNotes" name="notas" placeholder="Notas"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="heading_s1">
                        <h1>Tu Carrito de Compras</h1>
                    </div>
                    <div class="table-responsive order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::name('shopping')->getItems() as $item)
                                <tr>
                                    <td>{{$item->getDetails()->title}} <span class="product-qty">x {{$item->getDetails()->quantity}}</span></td>
                                    <td>${{ number_format($item->getDetails()->subtotal, 2, '.', ',') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SubTotal</th>
                                    <input type="hidden" id="checkoutSubtotal" value="{{ Cart::name('shopping')->getSubtotal() }}">
                                    <input type="hidden" id="cartCount" value="{{ Cart::name('shopping')->countItems() }}">
                                    <td class="product-subtotal">${{ number_format(Cart::name('shopping')->getSubtotal(), 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="product-subtotal">${{ number_format(Cart::name('shopping')->getTotal(), 2, '.', ',') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @php
                        $cartArray = [];
                        foreach (Cart::name('shopping')->getItems() as $item) {
                            array_push($cartArray, $item->getDetails());
                        }
                    @endphp
                    <input type="hidden" id="datosCarrito" name="datosCarrito" value="{{ json_encode($cartArray) }}">
                    <input type="hidden" id="wsInput" value="{{ Session::get('whatsapp') }}">

                    <a href="javascript:void(0)" class="btn btn-fill-out" id="whatsappCheckout">
                        <i class="ion-social-whatsapp-outline" style="font-size:30px;"></i> Procesar Orden
                    </a>

                    <a href="javascript:void(0)" class="btn btn-dark" onclick="history.back()">
                        <i class="fas fa-arrow-left" style="font-size:22px;"></i>  Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row py-3">
            <h4>
                Tu carrito de compras está vacío
            </h4>
        </div>
    </div>
    @endif
</div>
@endsection