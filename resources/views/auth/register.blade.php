@extends('layouts.public')
@section('title')
<title> Regístrate en CiudadGPS</title>
<meta name="description" content="Registrate como usuario y haz parte de la comunidad de comercios más grande de Latinoamérica" />
<meta name="keywords" content="Afiliar, comercio, negocio, emprendimiento, bolsa de empleo, talento, personal, captacion, trabajo, venezuela, comercio electrónico, viajes, trabajo, medicina, aplicación">
@endsection
@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/register.jpg') }}'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Regístrate</h1>
                </div>

                <div class="row mt-4 d-md-flex d-none">
                    <div class="col-md-3 pr-1">
                        <a 
                            href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" 
                            target="blank">
                            <img 
                                src="{{ asset('appButtons/play_store.png') }}" 
                                alt="App Store Button" 
                            />
                        </a>
                    </div>
                    <div class="pl-1 col-md-3">
                        <a 
                            href="https://apps.apple.com/us/app/ciudadgps/id1643027976"
                            target="blank">
                            <img 
                                src="{{ asset('appButtons/app_store.png') }}" 
                                alt="App Store Button" 
                            />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Regístrate</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-md-10">
            <div class="login_wrap">
                <div class="padding_eight_all bg-white">
                    <div class="heading_s1">
                        <h4>Crea tu Cuenta en CiudadGPS</h4>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                             name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre *">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico *">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" 
                            name="password" required autocomplete="new-password" placeholder="Contraseña *">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirmar Contraseña">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-fill-out btn-block" name="register">Regístrate</button>
                        </div>
                    </form>
                    <div class="different_login">
                        <span> o continuar con:</span>
                    </div>
                    <ul class="btn-login list_none text-center">
                        <li><a href="{{ url('auth/facebook?mode=web') }}" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                        <li><a href="{{ url('auth/google?mode=web') }}" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                        <!--<li><a href="{{ url('auth/apple?mode=web') }}" class="btn btn-dark"><i class="ion-social-apple"></i>Apple ID</a></li>-->
                    </ul>
                    <div class="form-note text-center">Ya tienes una cuenta creada? <a href="{{ route('login') }}">Inicia Sesión</a></div>
                </div>
            </div>
        </div>
    </div>
</div
@endsection
