@extends('layouts.public')
@section('title')
<title>Modificar Anuncio de Empleo - CiudadGPS</title>
@endsection
@section('content')
<div class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        Modificar Anuncio de Empleo
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ url('locales-asociados/jobs/' . $job->id . '/update')  }}" method="post" enctype="multipart/form-data">
                                    @csrf
            
                                    <div class="form-group">
                                        <label for="title" class="text-info">Cargo</label>
                                        <input type="text" class="form-control" required name="title" value="{{$job->title}}">
                                    </div>
            
                                    <div class="form-group">
                                        <label for="description" class="text-info">Descripción del Cargo</label>
                                        <textarea class="form-control" required name="description" rows="4">{!! $job->description !!}</textarea>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="user_email" class="text-info">E-Mail de Contacto:</label>
                                        <input type="email" class="form-control" required name="email" id="email" value="{{$job->email}}">
                                    </div>
            
                                    <div class="form-group">
                                        <label for="whatsapp" class="text-info">Whatsapp de Contacto:</label>
                                        <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="{{$job->whatsapp_number_code}}">
                                        <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="{{$job->whatsapp_code}}">
                                        <input type="hidden" name="whatsapp_number" id="whatsapp_number" value="{{$job->whatsapp_number}}">
                                        <input type="hidden" name="whatsapp" id="whatsapp" value="{{$job->whatsapp}}">
                                        <input type="text" id="whatsappFormatted" class="form-control" placeholder="412-1234567">
                                    </div>
            
                                    <button class="btn btn-fill-line">Modificar Empleo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection