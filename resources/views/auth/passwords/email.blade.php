@extends('layouts.public')
@section('title')
<title>Reestablece tu Cuenta</title>
@endsection
@section('content')
<div class="container py-5">
    <div class="row justify-content-center my-3 email-container">
        <div class="col-md-8">
            <div class="login_wrap">
                <div class="padding_eight_all bg-white">                
                
                    <div class="heading_s1">
                        <h3 class="text-center">Reestablecer Contraseña</h3>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ url('solicitarCodigo') }}" id="solicitarCodigo">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputEmail" aria-describedby="emailHelp" required autocomplete="email" autofocus value="{{ old('email') }}"
                            placeholder="Ingrese su Correo Electrónico:">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out btn-block">
                                    <i class="fas fa-envelope"></i> Enviar Código de Verificación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-3 d-none code-container">
        <div class="col-md-8">
            <div class="login_wrap">
                <div class="padding_eight_all bg-white">                
                
                    <div class="heading_s1">
                        <h3 class="text-center">Código de Verificación</h3>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ url('comprobarCodigo') }}" id="comprobarCodigo">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="number" name="code" class="form-control @error('code') is-invalid @enderror"
                            id="code" aria-describedby="emailHelp" required autocomplete="email" autofocus value="{{ old('email') }}"
                            placeholder="Ingrese su Código de Verificación:">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out btn-block">
                                    <i class="fas fa-check"></i> Verificar Código
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
