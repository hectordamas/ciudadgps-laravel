@extends('layouts.public')
@section('title')
<title>{{$job->title}} - CiudadGPS - Empleos</title>
<meta name="description" content="{{ $meta_description }}" />
<meta name="keywords" content="{{ $keywords }}">
@endsection
@section('content')
<?php 
    $message = "¡Hola! Estoy interesado/a en la oferta laboral de ".$job->title." publicada en CiudadGPS. ¿Podemos hablar más sobre ella?";
    $whatsappLink = "https://api.whatsapp.com/send/?phone=". $job->whatsapp . "&text=" . $message; 
?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/job_background.jpg') }}'); background-position: center center; background-size: cover; position: relative;"></div>
<div class="section">
	<div class="container">

        <div class="row justify-content-center">
                <div class="col-md-10 mb-3">

                    <div class="card shadow border-0">

                        <div class="card-body">

                            <div class="row">

                                <a href="/empleo/{{$job->slug}}" class="col-md-2 d-flex justify-content-center">
                                    <img src="{{$job->commerce->logo}}" style="width: 100px; height: 100px;" class="rounded-circle border" alt="{{$job->title}}" />
                                </a>

                                <div class="col-md-10">

                                    <h4 class="product_title">
                                        <a href="/empleo/{{$job->slug}}">{{$job->title}}</a>
                                    </h4>
                                    <h6>{{ $job->commerce->name }}</h6>
                                    <h6>{{ $job->created_at->diffForHumans() }}</h6>
                                    <div class="content-p">
                                        <p>{!! nl2br(e($job->description)) ?? 'No hay Descripción Disponible' !!}</p>
                                    </div>

                                    <h5>Información de Contacto:</h5>

                                    @if($job->email)
                                        <p class="d-flex align-items-center my-3">
                                            <i class="ti-email mr-2" style="font-size:25px;"></i> {{ $job->email }}
                                        </p>
                                    @endif                                
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>

                                <div class="col-md-10">
                                    @if($job->whatsapp)
                                    <a href="{{$whatsappLink}}" class="btn btn-success mb-3 mr-2">
                                        <i class="ion-social-whatsapp-outline" style="font-size:30px;"></i>Contactar Vía Whatsapp
                                    </a>
                                    @endif
                                    @if($job->email)
                                    <a href="mailto:{{$job->email}}" class="btn btn-dark mb-3 mr-2">
                                        <i class="ti-email" style="font-size:25px;"></i> Contactar Vía E-Mail
                                    </a>
                                    @endif                                
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


        </div>

    </div>
</div>
@endsection
