@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista de Comercios
            </div>
            <form class="card-body pagado" action="{{ url('action') }}" method="post" style="overflow-x: scroll;">
                @csrf
                <div class="row text-right">
                    <div class="col-md-12 form-group">
                        <button type="submit" name="accion" value="pagado" class="btn btn-primary btn-sm">
                            <i class="fas fa-check-double"></i> Marcar como pagado                   
                        </button>

                        <button type="submit" name="accion" value="nopagado" class="btn btn-dark btn-sm">
                            <i class="fas fa-times"></i> Marcar como no pagado                   
                        </button>

                        <button type="submit" name="accion" value="eliminar" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar                  
                        </button>
                    </div>
                </div>
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Creación</th>
                            <th>Negocio</th>
                            <th>Categoría</th>
                            <th>Método de Pago</th>
                            <th>Expiración</th>
                            <th>Pagado</th>
                            <th>Creado Por</th>
                            <th>Editar</th>
                            <th><input type="checkbox" id="checkAll" /></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commerces as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{date_format($c->created_at, 'd/m/Y')}}</td>
                                <td>
                                    @if(!(url('/') == 'http://localhost:8000'))
                                        <img 
                                            src="{!! $c->logo !!}" 
                                            width="30" 
                                            height="30" 
                                            class="rounded-circle" 
                                        /> 
                                    @endif
                                    <div>{{$c->name}}</div>
                                </td>
                                <td>{{$c->category ? $c->category->name : ''}}</td>
                                <td>{{$c->payment}}</td>
                                <td>{{ date_format(new DateTime($c->expiration_date), 'd/m/Y') }}</td>
                                <td>@if($c->paid) <i class="fa fa-check"></i> @endif</td>
                                <td>{{ $c->created_by }}</td>
                                <td>
                                    <a href="/commerces/{{$c->id}}/edit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkOne" value="{{$c->id}}" name="check[]"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection