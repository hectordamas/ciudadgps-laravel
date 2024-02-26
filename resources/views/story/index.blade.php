@extends('layouts.app')
@section('content')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="#" method="post" enctype="multipart/form-data" id="edit-story" class="modal-dialog modal-lg modal-dialog-centered">
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
                        <label for="user_name" class="text-dark font-weight-bold">Título de la historia:</label>
                        <input type="text" class="form-control" name="user_name" id="user_name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="user_image" class="text-dark font-weight-bold">Imagen de la historia</label>
                        <input type="file" class="form-control" name="user_image" id="user_image" accept="image/*">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición:</label>
                        <input type="text" class="form-control" name="position" id="position">
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
              <h6 class="modal-title text-dark font-weight-bold">Eliminar Historia</h6>
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
                        <h4 class="text-center">¿Estás seguro de eliminar esta historia?</h4>
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


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header font-weight-bold text-dark">
                Todas las Historias
            </div>
            <div class="card-body">
                <div class="row">

                    @forelse($stories as $s)
                    <div class="col-md-2 text-center my-3">
                        <div class="row">
                            <div class="col-md-12 text-center mb-2">
                                <img src="{{$s->user_image}}" alt="{{$s->user_name}}" style="width:80px; height:80px; object-fit: cover;" class="rounded-circle border border-danger">
                            </div>
                            <div class="col-md-12">
                                <h4 class="text-center" style="font-size:12px;">{{$s->user_name}}</h4>
                                <p style="font-size:12px;"><strong>Posición:</strong> {{$s->position}}</p>
                            </div>
                            <div class="col-md-12 text-center">
                                <a href="{{ route('stories.show', ['story' => $s->id]) }}" class="btn btn-info btn-sm">
                                    <i class="far fa-eye"></i> Ver Más
                                </a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm edit-story" data-position="{{$s->position}}" data-username="{{$s->user_name}}" data-id="{{$s->id}}" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm btn-delete" data-id="{{$s->id}}"  data-toggle="modal" data-target=".modal-delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-md-12 text-center">
                            <h4>No se han creado Historias</h4>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map')
<script>
    var colorSuccess = '#1cc88a'  

    $('.edit-story').on('click', function(){
        var id = $(this).data('id');
        var user_name = $(this).data('username');
        var position = $(this).data('position');

        $('#user_name').val(user_name);
        $('#position').val(position);
        $('#edit-story').attr('action', `/stories/${id}`);
    })

    $('.btn-delete').on('click', function(){
        var id = $(this).data('id');
        $('#delete-story').attr('action', `/stories/${id}`);
    })
</script>
@endsection