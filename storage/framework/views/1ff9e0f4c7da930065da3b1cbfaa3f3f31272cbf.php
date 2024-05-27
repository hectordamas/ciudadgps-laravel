
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Modificar Comercio #<?php echo e($commerce->id); ?>

            </div>
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-12 text-center">
                        <img src="<?php echo e($commerce->logo); ?>" style="width: 100px; height: 100px; border-radius:50%;">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <a 
                            href="<?php echo e(url('/comercios/' . $commerce->id)); ?>" 
                            class="btn btn-dark" target="blank">
                            <i class="fas fa-store"></i>
                            Ver Perfil del Establecimiento</a>
                    </div>
                </div>
                <form action="/commerces/<?php echo e($commerce->id); ?>/update" method="post" class="row" id="editCommerce" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-3 form-group">
                        <label for="name" class="text-dark font-weight-bold">Nombre del Negocio:</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo e($commerce->name); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="rif" class="text-dark font-weight-bold">RIF o Documento de Identidad:</label>
                        <input type="text" class="form-control" name="rif" id="rif" value="<?php echo e($commerce->rif); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="user_name" class="text-dark font-weight-bold">Nombre:</label>
                        <input type="text" class="form-control" required name="user_name" id="user_name" value="<?php echo e($commerce->user_name); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="user_lastname" class="text-dark font-weight-bold">Apellido:</label>
                        <input type="text" class="form-control" required name="user_lastname" id="user_lastname" value="<?php echo e($commerce->user_lastname); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="user_email" class="text-dark font-weight-bold">E-Mail:</label>
                        <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo e($commerce->user_email); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="telephone" class="text-dark font-weight-bold">Teléfono</label>
                        <input type="hidden" name="telephone_number_code" id="telephone_number_code" value="<?php echo e($commerce->telephone_number_code); ?>">
                        <input type="hidden" name="telephone_code" id="telephone_code" value="<?php echo e($commerce->telephone_code); ?>">
                        <input type="hidden" name="telephone_number" id="telephone_number" value="<?php echo e($commerce->telephone_number); ?>">
                        <input type="hidden" name="telephone" id="telephone" value="<?php echo e($commerce->telephone); ?>">
                        <input type="text" id="telephoneFormatted" class="form-control" placeholder="412-1234567">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="whatsapp" class="text-dark font-weight-bold">Whatsapp:</label>
                        <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="<?php echo e($commerce->whatsapp_number_code); ?>">
                        <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="<?php echo e($commerce->whatsapp_code); ?>">
                        <input type="hidden" name="whatsapp_number" id="whatsapp_number" value="<?php echo e($commerce->whatsapp_number); ?>">
                        <input type="hidden" name="whatsapp" id="whatsapp" value="<?php echo e($commerce->whatsapp); ?>">
                        <input type="text" id="whatsappFormatted" class="form-control" placeholder="412-1234567">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="logo" class="font-weight-bold text-dark">Cargar Logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="facebook" class="text-dark font-weight-bold">Facebook:</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo e($commerce->facebook); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="tiktok" class="text-dark font-weight-bold">TikTok:</label>
                        <input type="text" class="form-control" name="tiktok" id="tiktok" value="<?php echo e($commerce->tiktok); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="twitter" class="text-dark font-weight-bold">Twitter:</label>
                        <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo e($commerce->twitter); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="instagram" class="text-dark font-weight-bold">Instagram:</label>
                        <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo e($commerce->instagram); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="web" class="text-dark font-weight-bold">Página Web:</label>
                        <input type="text" class="form-control" name="web" id="web" value="<?php echo e($commerce->web); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="expiration_date" class="text-dark font-weight-bold">Fecha de Expiración:</label>
                        <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="<?php echo e($commerce->expiration_date); ?>">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="destacar" class="text-dark font-weight-bold">Destacar Comercio:</label>
                        <select name="destacar" id="destacar" class="form-control">
                            <option value="<?php echo e($commerce->destacar ? 'Destacar' : ''); ?>"><?php echo e($commerce->destacar ? 'Destacar' : 'No Destacar'); ?></option>
                            <option value="Destacar">Destacar</option>
                            <option value="">No Destacar</option>
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición</label>
                        <input type="number" name="position" id="position" class="form-control" value="<?php echo e($commerce->position); ?>" max="3">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="categories" class="text-dark font-weight-bold">Categoría:</label>
                        <select name="categories[]" id="categories" class="form-control js-example-tags" multiple>
                            <?php $__currentLoopData = $categories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $selected = in_array($c->id, $commerce->categories->pluck('id')->toArray()) ? 'selected' : '';
                                ?>
                                <option value="<?php echo e($c->id); ?>" <?php echo e($selected); ?>><?php echo e($c->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="col-md-3 form-group">
                        <label for="tags" class="text-dark font-weight-bold">Etiquetas:  separadas por Enter</label>
                        <select name="tags[]" id="tags" class="form-control js-example-tags" multiple>
                            <?php $__currentLoopData = $commerce->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->name); ?>" selected><?php echo e($t->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="" class="text-dark font-weight-bold">ID de Youtube:</label>
                        <input type="text" id="youtube" name="youtube" class="form-control" placeholder="" value="<?php echo e($commerce->youtube); ?>">
                    </div>

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="paid" style="font-size:11px;">
                                    <input type="checkbox" name="paid" id="paid" value="Sí" <?php if($commerce->paid): ?> checked <?php endif; ?>> Pagado
                                </label>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="hide" style="font-size:13px;" class="text-dark font-weight-bold">
                                    <input type="checkbox" name="hide" id="hide" value="Sí"  <?php if($commerce->hide): ?> checked <?php endif; ?>> Ocultar
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6 form-group">
                        <label for="address" class="text-dark font-weight-bold">Dirección:</label>

                        <textarea name="address" class="form-control" rows="3"><?php echo e($commerce->address); ?></textarea>
                    </div>


                    <div class="col-md-6 form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="font-weight-bold">Enlace de interes</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="<?php echo e($commerce->url); ?>" name="url" placeholder="URL de enlace de interes">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="<?php echo e($commerce->urlName); ?>" name="urlName" placeholder="Nombre del enlace">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="info" class="text-dark font-weight-bold">Descripción:</label>

                        <textarea name="info" id="info" class="form-control" rows="8"><?php echo $commerce->info; ?></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="ubicacion" class="text-dark font-weight-bold">Ubicación:</label>
                        <div id="map" class="w-100" style="height:300px;"></div>
                        <label for="lat">lat: <input type="text" name="lat" id="lat" value="<?php echo e($commerce->lat); ?>"></label>
                        <label for="lng">lon: <input type="text" name="lon" id="lng" value="<?php echo e($commerce->lon); ?>"></label>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i> Guardar Cambios
                        </button>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <hr>
                            <h5 class="font-weight-bold text-dark">Galería:</h5>
                        <hr>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="row" id="sortable-images">
                            <?php $__currentLoopData = $commerce->imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2 image<?php echo e($i->id); ?>">
                                <img src="<?php echo e(url($i->uri)); ?>" class="w-100" alt="" srcset="">
                                <a href="javascript:void(0);" class="text-danger destroy-image" data-id="<?php echo e($i->id); ?>" 
                                data-toggle="modal" data-target="#destroyImage">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <form action="<?php echo e(url('/images-upload')); ?>" class="dropzone" id="dropzone" enctype="multipart/form-data" method="post">
                            <div class="dz-message text-center">
                                <i class="fa fa-upload" style="font-size:30px; margin-bottom:20px;"></i>
                                <h4>Subir Imágenes</h4>
                            </div>
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="commerce_id" id="commerce_id" value="<?php echo e($commerce->id); ?>">
                            <input type="file" name="file" multiple accept="images/*" style="display: none;"/>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/commerces/edit.blade.php ENDPATH**/ ?>