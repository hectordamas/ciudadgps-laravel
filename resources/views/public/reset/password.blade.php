@extends('layouts.public')
@section('title')
<title>Reestablece tu Cuenta</title>
@endsection
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
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

                    <form method="POST" action="{{ url('cambiarContraseña') }}" id="cambiarContraseña">
                        
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" aria-describedby="passwordHelp" required autocomplete="password" autofocus value="{{ old('password') }}"
                            placeholder="Ingrese una Nueva Contraseña:">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out btn-block">
                                    <i class="fas fa-lock"></i> Cambiar Contraseña
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