@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Lista de Anuncios
            </div>
            <div class="card-body">
                <table class="table datatable table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Banner</th>
                            <th>Sección</th>
                            <th>Posición</th>
                            <th>URL</th>
                            <th>Comercio Asociado</th>
                            <th>Oculto</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $b)
                        <tr>
                            <td>{{$b->id}}</td>
                            <td><img src="{{$b->banner}}" width="60px"></td>
                            <td>{{$b->section}}</td>
                            <td>{{$b->position}}</td>
                            <td>@if($b->url) <a href="{{$b->url}}">Ver</a> @else N/A @endif </td>
                            <td>{{$b->commerce_id}}</td>
                            <td>@if(!$b->hide) <i class="fa fa-eye-slash"></i>@endif</td>
                            <td><a href="/banners/{{$b->id}}/edit" class="btn btn-primary"> <i class="fa fa-edit"></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection