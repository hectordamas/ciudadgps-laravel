
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Modificar Datos del Local</title>

<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/dropzone.min.css')); ?>" type="text/css" /> 
<style>
    #loadingLogo{
        position: fixed; 
        width: 100%;
        height: 100%; 
        background: rgba(0,0,0,0.5); 
        display: none; 
        justify-content: center; 
        align-items: center; 
        z-index: 1000; 
        top: 0; 
        right: 0;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="loadingLogo">
    <div class="spinner-border text-light" role="status"  style="width: 5rem; height: 5rem;">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-dark text-light">
                        Modificar Datos del Establecimiento
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(url('commerces/'. $commerce->id . '/update')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="userView" value="userView">
                            <input type="hidden" name="commerce_id" id="commerce_id" value="<?php echo e($commerce->id); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                        <h6>Datos de la empresa y persona de contacto</h6>
                                    <hr>
                                </div>
                            
                                <div class="col-md-6 form-group">
                                    <input type="text" required class="form-control" name="name" placeholder="Nombre del Negocio" value="<?php echo e($commerce->name); ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" required class="form-control" name="rif" placeholder="RIF y Documento de Identidad" value="<?php echo e($commerce->rif); ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" required class="form-control" name="user_name" placeholder="Nombre (persona de contacto)" value="<?php echo e($commerce->user_name); ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="user_lastnamee" placeholder="Apellido (persona de contacto)" value="<?php echo e($commerce->user_lastname); ?>"> 
                                </div>
                                <div class="col-md-12 form-group text-right">
                                    <button type="submit" class="btn btn-fill-out">
                                        <i class="fas fa-save"></i> Guardar Información
                                    </button>
                                </div>
                            </div>
                            <hr>
                                <h6>Información de Contacto</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="hidden" name="telephone_number_code" id="telephone_number_code" value="<?php echo e($commerce->telephone_number_code); ?>">
                                    <input type="hidden" name="telephone_code" id="telephone_code" value="<?php echo e($commerce->telephone_code); ?>">
                                    <input type="hidden" name="telephone_number" id="telephone_number" value="<?php echo e($commerce->telephone_number); ?>">
                                    <input type="hidden" name="telephone" id="telephone" value="<?php echo e($commerce->telephone); ?>">
                                    <input type="text" id="telephoneFormatted" class="form-control" placeholder="Teléfono">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="<?php echo e($commerce->whatsapp_number_code); ?>">
                                    <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="<?php echo e($commerce->whatsapp_code); ?>">
                                    <input type="hidden" name="whatsapp_number" id="whatsapp_number" value="<?php echo e($commerce->whatsapp_number); ?>">
                                    <input type="hidden" name="whatsapp" id="whatsapp" value="<?php echo e($commerce->whatsapp); ?>">
                                    <input type="text" id="whatsappFormatted" class="form-control" placeholder="WhatsApp">
                                </div>
        
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->facebook); ?>" name="facebook" id="facebook" placeholder="Enlace Facebook">
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->twitter); ?>" name="twitter" id="twitter" placeholder="Enlace Twitter">
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->instagram); ?>" name="instagram" id="instagram" placeholder="Enlace Instagram">
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->tiktok); ?>" name="tiktok" id="tiktok" placeholder="Enlace Tiktok">
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->threads); ?>" name="threads" id="threads" placeholder="Enlace Threads">
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->youtube); ?>" id="youtube" name="youtube" placeholder="ID de Youtube">
                                </div>
            
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->web); ?>" name="web" id="web" placeholder="Enlace Página Web">
                                </div>
        
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->url); ?>" name="url" id="url" placeholder="Enlace de Interés">
                                </div>
            
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" value="<?php echo e($commerce->urlName); ?>"  name="urlName" id="urlName"  placeholder="Nombre del Enlace de Interés">
                                </div>
    
                                <div class="col-md-12 form-group text-right">
                                    <button type="submit" class="btn btn-fill-out">
                                        <i class="fas fa-save"></i> Guardar Información
                                    </button>
                                </div>
    
                                <div class="col-md-12">
                                    <hr>
                                        <h6>Información del Rubro</h6>
                                    <hr>
                                </div>
    
    
                                <div class="col-md-6 form-group">
                                    <label for="category">Categoría:</label>
                                    <select name="categories[]" id="categories[]" multiple class="form-control js-example-tags" required>
                                        <?php $__currentLoopData = $categories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $selected = in_array($c->id, $commerce->categories->pluck('id')->toArray()) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo e($c->id); ?>" <?php echo e($selected); ?>><?php echo e($c->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
        
                                <div class="col-md-6 form-group">
                                    <label for="tags">Etiquetas: separar cada etiqueta con Enter</label>
                                    <select name="tags[]" id="tags" class="form-control js-example-tags" multiple required>
                                        <?php $__currentLoopData = $commerce->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($t->name); ?>" selected><?php echo e($t->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <textarea name="info" id="info" class="form-control" required rows="6" placeholder="Descripción"><?php echo $commerce->info; ?></textarea>
                                </div>
    
                                <div class="col-md-12 form-group text-right">
                                    <button type="submit" class="btn btn-fill-out">
                                        <i class="fas fa-save"></i> Guardar Información
                                    </button>
                                </div>
    
                                <div class="col-md-12">
                                    <hr>
                                        <h6>Ubicación del Comercio</h6>
                                    <hr>
                                </div>
    
                                
                                <div class="col-md-6 form-group">
                                    <textarea name="address" id="address" placeholder="Dirección Escrita del Establecimiento" class="form-control" required rows="8"><?php echo e($commerce->address); ?></textarea>
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <div id="map" class="w-100" style="height:200px;"></div>
                                    <p>Arrastra el cursor hasta la zona de tu ubicación, tienda física o dirección de entrega.</p>
                                    <input type="hidden" name="lat" id="lat" value="<?php echo e($commerce->lat); ?>">
                                    <input type="hidden" name="lon" id="lng" value="<?php echo e($commerce->lon); ?>">
                                </div>
    
                                <div class="col-md-12 form-group text-right">
                                    <button type="submit" class="btn btn-fill-out">
                                        <i class="fas fa-save"></i> Guardar Información
                                    </button>
                                </div>
    

    
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                    <h6>Imágenes del Establecimiento</h6>
                                <hr>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="logo">Logo del Negocio:</label>
                                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                                <img class="shadow mt-3" src="<?php echo e(asset($commerce->logo)); ?>" width="100" height="100" style="border-radius: 100%;">
                            </div>

                            <div class="col-md-6 form-group">
                                <form action="<?php echo e(url('/images-upload')); ?>" class="dropzone" id="dropzone" enctype="multipart/form-data" method="post">
                                    <div class="dz-message text-center">
                                        <i class="fa fa-upload" style="font-size:30px; margin-bottom:20px;"></i>
                                        <h6>Arrastra las imágenes del establecimiento a esta zona.</h6>
                                    </div>
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="commerce_id" id="commerce_id" value="<?php echo e($commerce->id); ?>">
                                    <input type="file" name="file" multiple accept="images/*" style="display: none;"/>
                                </form>

                                <div class="row mt-3">
                                    <div class="col-md-12 form-group">
                                        <div class="row" id="sortable-images">
                                            <?php $__currentLoopData = $commerce->imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-3 image<?php echo e($i->id); ?> px-1">
                                                <img src="<?php echo e(url($i->uri)); ?>" class="w-100" alt="" srcset="">
                                                <a href="javascript:void(0);" class="text-danger destroy-image" data-id="<?php echo e($i->id); ?>" 
                                                data-toggle="modal" data-target="#destroyImage">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="modal fade" method="post" id="destroyImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="image_id" id="image_id">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="far fa-times-circle text-primary" style="font-size:60px;"></i>
            </div>
            <div class="col-md-12 mt-3">
                <h5 class="text-center text-dark">¿Estás seguro de eliminar esta imagen?</h5>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="<?php echo e(asset('assetsPublic/js/dropzone.min.js')); ?>"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcWkdk6cq3cMIUqrJK36j7aErEOlWdqVo&callback=initMap">
</script>

<script>
    var latInput = document.getElementById('lat');
    var lonInput = document.getElementById('lng');
    var lat = parseFloat(latInput.value);
    var lon = parseFloat(lonInput.value);
    var mapContainer = document.getElementById('map');

    function initMap() {
        var map = new google.maps.Map(mapContainer, {
            center: {lat: lat, lng: lon },
            zoom: 13
        });

        var marker = new google.maps.Marker({
            position: {lat: lat, lng: lon },
            draggable:true,
            map: map
        });

        
        // Actualizar las coordenadas cuando cambien los campos de entrada
        latInput.addEventListener('input', function () {
          lat = parseFloat(latInput.value);
          updateMarkerPosition();
        });
    
        lonInput.addEventListener('input', function () {
          lon = parseFloat(lonInput.value);
          updateMarkerPosition();
        });
    
        function updateMarkerPosition() {
          marker.setPosition({ lat: lat, lng: lon });
          map.setCenter({ lat: lat, lng: lon });
        }

        google.maps.event.addListener(marker, 'drag', function(event){
            latInput.value = event.latLng.lat();
            lonInput.value = event.latLng.lng();
            lat = parseFloat(latInput.value);
            lon = parseFloat(lonInput.value);
        });
    }

    window.initMap = initMap;
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('sortable-images');
        var sortable = Sortable.create(el, {
            animation: 150,
            onEnd: function (evt) {
                var itemEl = evt.item;  // item that was dragged
                // You can get the new order of items and send it to the server if needed
                var order = [];
                $('#sortable-images .col-md-2').each(function (index, element) {
                    var id = $(element).attr('class').match(/image(\d+)/)[1];
                    order.push(id);
                });
                
                // Send the new order to the server via AJAX
                $.ajax({
                    url: '/update-image-order',
                    method: 'POST',
                    data: {
                        order: order,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function (response) {
                        console.log('Order updated successfully');
                    },
                    error: function (xhr) {
                        console.error('Error updating order', xhr);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#logo').on('change', function(e) {
            e.preventDefault();
            $('#loadingLogo').css('display', 'flex');

            var formData = new FormData();
            formData.append('logo', $('#logo')[0].files[0]);
            formData.append('commerce_id', $('#commerce_id').val());

            $.ajax({
                url: '<?php echo e(route('upload-logo')); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('img.shadow.mt-3').attr('src', response.logo_url);
                        $('#loadingLogo').css('display', 'none');
                    } else {
                        alert('Error al subir el logo');
                    }
                },
                error: function(xhr) {
                    console.error('Error en la solicitud:', xhr);
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/edit.blade.php ENDPATH**/ ?>