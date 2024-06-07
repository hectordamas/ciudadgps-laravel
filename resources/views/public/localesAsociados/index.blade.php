@extends('layouts.public')
@section('title')
<title>CiudadGPS - Locales Asociados</title>
@endsection
@section('content')
<div class="section py-5">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-dark text-light">Locales Asociados</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped shop_cart_table">
                            <tbody>
                                @foreach($commerces as $commerce)
                                <tr>
                                    <td>
                                        <img 
                                            class="border shadow"
                                            src="{{ asset($commerce->logo) }}" 
                                            alt="Logo {{$commerce->name}}" 
                                            srcset="{{ asset($commerce->logo) }}"
                                            width="50"
                                            height="50"
                                            style="border-radius: 100%;"
                                        />
                                    </td>
                                    <td>{{$commerce->name}}</td>
                                    <td>
                                        <div class="dropdown">
                                         <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton{{$commerce->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                         </button>
                                         <div class="dropdown-menu shadow border-0" aria-labelledby="dropdownMenuButton{{$commerce->id}}">
                                            <a class="dropdown-item" target="blank" href="{{ url('slug-comercios/' . $commerce->slug) }}">
                                                <i class="fas fa-store"></i> Ir al Perfil Comercial
                                            </a>
                                            <a class="dropdown-item" target="blank" href="{{ url('locales-asociados/' . $commerce->id . '/edit') }}">
                                                <i class="fas fa-edit"></i> Modificar Datos del Comercio
                                            </a>
                                            <a class="dropdown-item" target="blank" href="{{ url('locales-asociados/productos/' . $commerce->id) }}">
                                                <i class="fas fa-shopping-cart"></i> Catálogo de Productos
                                            </a>
                                            <a class="dropdown-item" target="blank" href="{{ url('locales-asociados/jobs/' . $commerce->id) }}">
                                                <i class="fas fa-briefcase"></i> Bolsa de Empleos
                                            </a>
                                            <a class="dropdown-item" target="blank" href="{{ url('locales-asociados/horarios/' . $commerce->id) }}">
                                                <i class="fas fa-clock"></i> Horarios de Atención
                                            </a>
                                            <a class="dropdown-item" target="blank" href="{{ url('locales-asociados/performance/' . $commerce->id) }}">
                                                <i class="fas fa-chart-bar"></i> Rendimiento del Perfil
                                            </a>
                                         </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection