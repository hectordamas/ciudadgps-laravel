@extends('layouts.public')
@section('title')
<title>Mi Cuenta</title>
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="dashboard_menu">
                <ul class="nav nav-tabs flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-user"></i> Mi Cuenta</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('favoritos') }}"><i class="ti-heart"></i>Favoritos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form1').submit();"><i class="ti-lock"></i>Cerrar Sesión</a>
                        <form id="logout-form1" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    
                  </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="tab-content dashboard_content">
                <div class="tab-pane active" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
					<div class="card">
                    	<div class="card-header">
                            <h3 class="text-center">Información de tu cuenta</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/update/account/{{$user->id}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 d-flex justify-content-center">
                                        <img src="{{Auth::user()->avatar ? Auth::user()->avatar : asset('assets/user_avatar_default.png') }}" referrerpolicy="no-referrer" alt="{{Auth::user()->name}}" style="width:120px; height:120px; border-radius:50%;">
                                    </div>
                                    <div class="form-group col-md-12 text-center mb-5">
                                        <label class="btn btn-fill-out text-light btn-radius btn-sm" for="avatar"><i class="fas fa-user"></i> Subir Imagen</label>
                                        <input type="file" name="avatar" accept="image/*" style="display:none;" id="avatar">
                                        <strong id="avatarCaption" class="d-block"></strong>
                                    </div>
                                    <div class="form-group col-md-6">
                                    	<label for="name">Nombre <span class="required">*</span></label>
                                        <input required class="form-control" name="name" type="text" id="name" value="{{$user->name}}">
                                     </div>
                                    <div class="form-group col-md-6">
                                    	<label>Correo Electrónico <span class="required">*</span></label>
                                        <input required class="form-control" name="email" 
                                            @if($user->google_id || $user->facebook_id) readonly @endif 
                                            type="email" value="{{$user->email}}" 
                                        />
                                        @if($user->google_id)<p>inicias sesion con google</p>@endif 
                                        @if($user->facebook_id)<p>inicias sesion con facebook</p>@endif 
                                    </div>
                                    <div class="form-group col-md-6">
                                    	<label>Contraseña <span class="required">*</span></label>
                                        <input class="form-control" name="password" type="password">
                                    </div>
                                    <div class="form-group col-md-6">
                                    	<label>Confirmar Contraseña <span class="required">*</span></label>
                                        <input class="form-control" name="npassword" type="password">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">
                                            <i class="fas fa-check"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection