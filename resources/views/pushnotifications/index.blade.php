@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista de Notificaciones
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <th></th>
                        <th>Titulo</th>
                        <th>Mensaje</th>
                    </thead>
                    <tbody>
                        @foreach ($pushnotifications as $notification)
                        <tr>
                            <td>{{$notification->created_at}}</td>
                            <td>{{$notification->title}}</td>
                            <td>{{$notification->message}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
