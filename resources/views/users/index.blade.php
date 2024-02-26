@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Lista De Usuarios
            </div>
            <div class="card-body">
                <table class="table datatable table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>E-Mail</th>
                            <th>Rol</th>
                            <th>Fecha de registro</th>
                            <th>Locales</th>
                            <th><i class="fab fa-facebook-f"></i></th>
                            <th><i class="fab fa-google"></i></th>
                            <th>Editar</th>
                            <th><input type="checkbox" name="" id=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->commerces ? $user->commerces->count() : 0}}</td>
                            <td> @if($user->facebook_id) <i class="fas fa-check"></i> @endif </td>
                            <td> @if($user->google_id) <i class="fas fa-check"></i> @endif </td>
                            <td>
                                <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td><input type="checkbox" name="" id=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection