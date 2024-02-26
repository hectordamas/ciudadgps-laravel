@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header text-dark font-weight-bold">
                    Crear Usuario
                </div>
                <div class="card-body">
                    <form action="/users/store" method="post" class="row">
                        @csrf
                        <div class="col-md-3 form-group">
                            <label for="name" class="font-weight-bold text-dark">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="email" class="font-weight-bold text-dark">Correo Electrónico:</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>                        
                        <div class="col-md-3 form-group">
                            <label for="role" class="font-weight-bold text-dark">Rol:</label>
                            <select name="role" id="role" class="form-control">
                                <option value="Usuario">Usuario</option>
                                <option value="Administrador">Administrador</option>
                            </select>
                        </div>                           
                        <div class="col-md-3 form-group">
                            <label for="password" class="font-weight-bold text-dark">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="Crear Usuario" class="btn btn-dark">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection