@extends('layouts.app')
@section('content')
@php
function excerpt($title){
    if (strlen($title) < 50) {
        return $title;
    } else {
       $new = wordwrap($title, 50);
       $new = explode("\n", $new);
       $new = $new[0] . '...';

       return $new;
    }
}    
@endphp
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="#" method="post" enctype="multipart/form-data" id="edit-item" class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title text-dark font-weight-bold">Editar Historia</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @method('put')
                    @csrf
                    <div class="col-md-6 form-group">
                        <label for="swipeText" class="text-dark font-weight-bold">Texto:</label>
                        <textarea class="form-control" name="swipeText" id="swipeText" rows="5"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="user_image" class="text-dark font-weight-bold">Imagen:</label>
                        <input type="file" class="form-control" name="story_image" id="story_image" accept="image/*">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición:</label>
                        <input type="text" class="form-control" name="position" id="position">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="link" class="text-dark font-weight-bold">Link:</label>
                        <input type="text" class="form-control" name="link" id="link">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="linkText" class="text-dark font-weight-bold">Texto del enlace:</label>
                        <input type="text" class="form-control" name="linkText" id="linkText">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios</button>
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </form>
</div>
<div class="modal fade modal-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="#" method="post" enctype="multipart/form-data" id="delete-story" class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title text-dark font-weight-bold">Eliminar Item</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @method('delete')
                    @csrf
                    <div class="col-md-12 d-flex justify-content-center align-items-center text-center my-3">
                        <i class="far fa-times-circle text-danger fa-5x"></i>
                    </div>

                    <div class="col-md-12 my-3">
                        <h4 class="text-center">¿Estás seguro de eliminar este Item?</h4>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Aceptar</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade modal-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="{{ route('storyitems.store') }}" method="post" enctype="multipart/form-data" id="delete-story" class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title text-dark font-weight-bold">Crear Item</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @csrf
                    <input type="hidden" name="story_id" value="{{$story->id}}">

                    <div class="col-md-6 form-group">
                        <label for="swipeText" class="text-dark font-weight-bold">Texto:</label>
                        <textarea class="form-control" name="swipeText" id="swipeText" rows="5"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="user_image" class="text-dark font-weight-bold">Imagen:</label>
                        <input type="file" class="form-control" name="story_image" id="story_image" accept="image/*">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición:</label>
                        <input type="text" class="form-control" name="position" id="position">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="link" class="text-dark font-weight-bold">Link:</label>
                        <input type="text" class="form-control" name="link" id="link">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="linkText" class="text-dark font-weight-bold">Texto del enlace:</label>
                        <input type="text" class="form-control" name="linkText" id="linkText">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios</button>
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </form>
</div>
<div class="modal fade modal-delete-items" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title text-dark font-weight-bold">Eliminar Item</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center align-items-center text-center my-3">
                        <i class="far fa-times-circle text-danger fa-5x"></i>
                    </div>

                    <div class="col-md-12 my-3">
                        <h4 class="text-center">¿Estás seguro de eliminar los items seleccionados?</h4>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-sm btn-primary" id="aceptar">Aceptar</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <a href="/stories" class="btn btn-dark btn-sm"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header font-weight-bold text-dark">
                Items de Historia: {{$story->user_name}}
            </div>
            <form  method="POST" action="/eliminarVariosItems" class="card-body" id="eliminarVarios">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modal-create"><i class="far fa-plus-square"></i> Crear nuevo Item</a>
                        <a href="javascript:void(0);"  class="btn btn-danger btn-sm btn-delete-items" data-toggle="modal" data-target=".modal-delete-items">
                            <i class="fas fa-trash-alt"></i> Eliminar seleccionados
                        </a>
                    </div>
                </div>

                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                        <th>ID Item:</th>
                        <th>Historia:</th>
                        <th>Texto:</th>
                        <th>Posición:</th>
                        <th>Enlace</th>
                        <th>Acciones</th>
                        <th>
                            <input type="checkbox" id="checkAll">
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($story->stories as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <img src="{{ $item->story_image }}" style="width:50px; height:50px; object-fit: cover;" class="rounded-circle border border-danger">
                                </td>
                                <td>
                                    {{ excerpt($item->swipeText) }}
                                </td>
                                <td>{{$item->position}}</td>
                                <td><a href="{{$item->link}}" target="blank">{{excerpt($item->linkText)}}</a></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-success btn-sm edit-item" 
                                    data-position="{{$item->position}}" 
                                    data-swipetext="{{$item->swipeText}}" 
                                    data-link="{{$item->link}}" 
                                    data-linktext="{{$item->linkText}}" 
                                    data-id="{{$item->id}}" data-toggle="modal" data-target=".bd-example-modal-lg">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"  class="btn btn-danger btn-sm btn-delete" 
                                    data-id="{{$item->id}}"  data-toggle="modal" data-target=".modal-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <input type="checkbox" name="items[]" value={{$item->id}} class="checkOne">
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

@section('map')
<script>
    var colorSuccess = '#1cc88a'  

    $('.edit-item').on('click', function(){
        var id = $(this).data('id');
        var swipeText = $(this).data('swipetext');
        var position = $(this).data('position');
        var link = $(this).data('link');
        var linkText = $(this).data('linktext');

        $('#swipeText').val(swipeText);
        $('#position').val(position);
        $('#link').val(link);
        $('#linkText').val(linkText);
        $('#edit-item').attr('action', `/storyitems/${id}`);
    })

    $('.btn-delete').on('click', function(){
        var id = $(this).data('id');
        $('#delete-story').attr('action', `/storyitems/${id}`);
    })

    $('#aceptar').on('click', function(){
        $('#eliminarVarios').submit();
    })
</script>
@endsection