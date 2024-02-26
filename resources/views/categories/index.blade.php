@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista De Categorías
            </div>
            <div class="card-body" style="overflow-x: scroll; padding-right:30px;">
                <table class="datatable table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Creado</th>
                            <th>Categoría</th>
                            <th></th>
                            <th>Posición</th>
                            <th>Oculta</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{date_format($c->created_at, 'd/m/Y')}}</td>
                                <td>{{$c->name}}</td>
                                <td><img src="{{$c->image_url}}" alt="{{$c->name}}" width="30px"></td>
                                <td>{{$c->position}}</td>
                                <td>
                                    @if($c->hidden) <i class="far fa-eye-slash"></i>@endif
                                </td>
                                <td>
                                    <a href="{{ route('category.edit', ['category' => $c->id]) }}" class="btn btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection