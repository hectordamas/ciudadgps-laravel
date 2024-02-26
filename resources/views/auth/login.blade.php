@extends('layouts.public')
@section('title')
<title>Inicia Sesión en CiudadGPS</title>
@endsection
@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/login.jpg') }}'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Inicia Sesión</h1>
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
                    <li class="breadcrumb-item text-light active">Inicia Sesión</li>
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
                        <h4>Bienvenido Nuevamente!</h4>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputEmail" aria-describedby="emailHelp" required autocomplete="email" autofocus
                            placeholder="Ingrese su Correo Electrónico:">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user  @error('password') is-invalid @enderror"
                            id="exampleInputPassword" required autocomplete="current-password"
                            placeholder="Ingrese su Contraseña:">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="login_footer form-group">
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Permanece Conectado</span></label>
                                </div>
                            </div>
                            <a href="{{ route('password.request') }}">Olvidó su contraseña?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-fill-out btn-block" name="login">Inicia Sesión</button>
                        </div>
                    </form>
                    <div class="different_login">
                        <span> o Continuar con:</span>
                    </div>
                    <ul class="btn-login list_none text-center">
                        <li><a href="{{ url('auth/facebook?mode=web') }}" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                        <li><a href="{{ url('auth/google?mode=web') }}" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                        <li><a href="{{ url('auth/apple?mode=web') }}" class="btn btn-dark"><i class="ion-social-apple"></i>Apple ID</a></li>
                    </ul>
                    <div class="form-note text-center">No tienes una cuenta? <a href="{{route('register')}}">Regístrate</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
