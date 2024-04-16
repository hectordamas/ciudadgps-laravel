@extends('layouts.public')
@section('title')
<title>Categorías en CiudadGPS</title>
<meta name="description" content="Conoce las más de 100 categorías que tiene CiudadGPS" />
<meta name="keywords" content="Afiliar, comercio, negocio, emprendimiento, bolsa de empleo, talento, personal, captacion, trabajo, venezuela, comercio electrónico, viajes, trabajo, medicina, aplicación, comercios en caracas, comercios en venezuela">
@endsection
@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/categorias.jpg') }}'); background-position: center center; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.7);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Todas las Categorías</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Categorías</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12">
                <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow">
                            <div class="categories_box">
                                <a href="{{ url('/comercios/slug-categorias/' . $category->slug ) }}" class="category-link">
                                    <img src="{{ asset($category->image_url) }}" alt="Icono de la categoria: {{$category->name}}" style="height:40px; width:40px; margin:auto;" class="mb-4">
                                    <span class="text-dark text-uppercase font-weight-bold" style="font-size:12px;">
                                        {{$category->name}}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection