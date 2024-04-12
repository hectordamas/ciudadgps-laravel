@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Lista de Artículos
            </div>
            <div class="card-body">
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Creado</th>
                            <th>Articulo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{$article->id}}</td>
                            <td>{{ $article->created_at->diffForHumans() }}</td>
                            <td>{{ Illuminate\Support\Str::limit($article->title, 100) }}</td>
                            <td>
                                <a href="{{ url('articles/' . $article->id . '/edit') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
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