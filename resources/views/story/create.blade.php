@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Crear Nueva Historia
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('stories.store') }}" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-3 form-group">

                                <label for="user_name" class="font-weight-bold text-dark">Nombre de la Historia:</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Coloca el nombre que quieres que aparezca en la historia">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="user_image" class="font-weight-bold text-dark">Imagen de la Historia:</label>
                                <input type="file" name="user_image" id="user_image" class="form-control" accept="image/*">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="position_story" class="font-weight-bold text-dark">Posición:</label>
                                <input type="number" class="form-control" id="position_story" name="position_story">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                    <p class="text-dark font-weight-bold text-uppercase text-small" style="font-size:12px;">Crear items para la historia:</p>
                                <hr>
                            </div>
                        </div>

                        <div class="row" id="story-items-container">
                            <input type="hidden" name="itemCounter" id="itemCounter" value="1">

                            <div class="col-md-12" id="item1">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="swipeText" class="font-weight-bold text-dark">Texto del Item:</label>
                                        <textarea class="form-control summernote-dark-mode" id="swipeText" name="swipeText[]" placeholder="Coloca el texto que quieres que aparezca en el item"></textarea>
                                    </div>
        
                                    <div class="col-md-3 form-group">
                                        <label for="story_image" class="font-weight-bold text-dark">Imagen del Item:</label>
                                        <input type="file" name="story_image[]" id="story_image" class="form-control" accept="image/*">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="link" class="font-weight-bold text-dark">Enlace a:</label>
                                        <input type="text" class="form-control" id="link" name="link[]">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="linkText" class="font-weight-bold text-dark">Texto de Enlace:</label>
                                        <input type="text" class="form-control" id="linkText" name="linkText[]">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="position" class="font-weight-bold text-dark">Posición:</label>
                                        <input type="number" class="form-control" id="position" name="position[]">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <br>
                                            </div>
                                            <div class="col-md-12 d-flex mt-2">
                                                <button type="button" onClick="addItem()" class="btn btn-dark btn-sm rounded-0 mr-2"><i class="far fa-plus-square"></i> Nuevo Item</button>
                                                <button type="button" onClick="removeItem()" class="btn btn-danger btn-sm rounded-0" data-id="1"><i class="fas fa-trash-alt"></i> Eliminar Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark">Crear Historia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map')
<script>

    var itemCounter = parseInt($('#itemCounter').val());

    function addItem(){
        itemCounter = itemCounter + 1;

        $('#story-items-container').append(`
            <div class="col-md-12" id="item${itemCounter}">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="swipeText" class="font-weight-bold text-dark">Texto del Item:</label>
                        <textarea class="form-control" id="swipeText" name="swipeText[]" placeholder="Coloca el texto que quieres que aparezca en la historia"></textarea>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="story_image" class="font-weight-bold text-dark">Imagen del Item:</label>
                        <input type="file" name="story_image[]" id="story_image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="link" class="font-weight-bold text-dark">Enlace a:</label>
                        <input type="text" class="form-control" id="link" name="link[]">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="linkText" class="font-weight-bold text-dark">Texto de Enlace:</label>
                        <input type="text" class="form-control" id="linkText" name="linkText[]">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="position" class="font-weight-bold text-dark">Posición:</label>
                        <input type="number" class="form-control" id="position" name="position[]">
                    </div>
                    <div class="col-md-3 form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                            </div>
                            <div class="col-md-12 d-flex mt-2">
                                <button type="button" onClick="addItem()" class="btn btn-dark btn-sm rounded-0 mr-2"><i class="far fa-plus-square"></i> Nuevo Item</button>
                                <button type="button" onClick="removeItem(${itemCounter})" class="btn btn-danger btn-sm rounded-0"><i class="fas fa-trash-alt"></i> Eliminar Item</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }

    function removeItem($id){
        $(`#item${$id}`).remove();
    }
</script>
@endsection