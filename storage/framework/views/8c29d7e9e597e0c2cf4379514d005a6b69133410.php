
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Crear Nuevo Comercio
            </div>
            <div class="card-body">
                <div class="row" id="dropzone_container">
                    <div class="col-md-12">
                        <div class="row mb-3 text-center">
                            <div class="col-md-12 text-center mb-2">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="continuar">Continuar Editando</a>
                            </div>
                        </div>
                        <div class="row mb-3 text-center">
                            <div class="col-md-12 text-center mb-2">
                                <img id="img_commerce_created" width="120" height="120" style="border-radius:50%;">
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 id="name_commerce_created"></h4>
                            </div>
                        </div>
                        <form action="<?php echo e(url('/images-upload')); ?>" class="dropzone" id="dropzone" enctype="multipart/form-data" method="post">
                            <div class="dz-message text-center">
                                <i class="fa fa-upload" style="font-size:30px; margin-bottom:20px;"></i>
                                <h4>Subir Imágenes</h4>
                            </div>
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="commerce_id" id="commerce_id">
                            <input type="file" name="file" multiple accept="images/*" style="display: none;"/>
                        </form>   
                    </div>
                </div>             
                    
                <form action="<?php echo e(route('commerces.store')); ?>" method="post" class="row" id="storeCommerce" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-3 form-group">
                        <label for="name" class="text-dark font-weight-bold">Nombre del Negocio:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="rif" class="text-dark font-weight-bold">RIF o Documento de Identidad:</label>
                        <input type="text" class="form-control" name="rif" id="rif">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="user_name" class="text-dark font-weight-bold">Nombre:</label>
                        <input type="text" class="form-control" name="user_name" id="user_name">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="user_lastname" class="text-dark font-weight-bold">Apellido:</label>
                        <input type="text" class="form-control" name="user_lastname" id="user_lastname">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="user_email" class="text-dark font-weight-bold">E-Mail:</label>
                        <input type="email" class="form-control" name="user_email" id="user_email">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="telephone" class="text-dark font-weight-bold">Teléfono</label>
                        <input type="hidden" name="telephone_number_code" id="telephone_number_code" value="+58">
                        <input type="hidden" name="telephone_code" id="telephone_code" value="VE">
                        <input type="hidden" name="telephone_number" id="telephone_number">
                        <input type="hidden" name="telephone" id="telephone">
                        <input type="text" id="telephoneFormatted" class="form-control" placeholder="212-1234567">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="whatsapp" class="text-dark font-weight-bold">Whatsapp:</label>
                        <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="+58">
                        <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="VE">
                        <input type="hidden" name="whatsapp_number" id="whatsapp_number">
                        <input type="hidden" name="whatsapp" id="whatsapp">
                        <input type="text" id="whatsappFormatted" class="form-control" placeholder="412-1234567">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="logo" class="font-weight-bold text-dark">Cargar Logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="facebook" class="text-dark font-weight-bold">Facebook:</label>
                        <input type="text" class="form-control" name="facebook" id="facebook">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="tiktok" class="text-dark font-weight-bold">TikTok:</label>
                        <input type="text" class="form-control" name="tiktok" id="tiktok">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="twitter" class="text-dark font-weight-bold">Twitter:</label>
                        <input type="text" class="form-control" name="twitter" id="twitter">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="instagram" class="text-dark font-weight-bold">Instagram:</label>
                        <input type="text" class="form-control" name="instagram" id="instagram">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="web" class="text-dark font-weight-bold">Página Web:</label>
                        <input type="text" class="form-control" name="web" id="web">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="expiration_date" class="text-dark font-weight-bold">Fecha de Expiración:</label>
                        <input type="date" class="form-control" name="expiration_date" id="expiration_date">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="destacar" class="text-dark font-weight-bold">Destacar Comercio:</label>
                        <select name="destacar" id="destacar" class="form-control">
                            <option value="">No Destacar</option>
                            <option value="Destacar">Destacar</option>
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="position" class="text-dark font-weight-bold">Posición</label>
                        <input type="number" name="position" id="position" class="form-control" max="3">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="category" class="text-dark font-weight-bold">Categoría:</label>
                        <select name="category" id="category" class="form-control select2">
                            <option value="" selected>Seleccionar Elemento</option>
                            <?php $__currentLoopData = $categories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="tags" class="text-dark font-weight-bold">Etiquetas: separar cada etiqueta con Enter</label>
                        <select name="tags[]" id="tags" class="form-control js-example-tags" multiple></select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="" class="text-dark font-weight-bold">ID de Youtube:</label>
                        <input type="text" id="youtube" name="youtube" class="form-control" placeholder="">
                    </div>


                    <div class="col-md-3 form-group">
                        <label for="paid" style="font-size:13px;" class="text-dark font-weight-bold">
                            <input type="checkbox" name="paid" id="paid" value="Sí" checked class="mr-2"> Pagado
                        </label>
                    </div>


                    <div class="col-md-6 form-group">
                        <label for="address" class="text-dark font-weight-bold">Dirección:</label>

                        <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="excerpt" class="text-dark font-weight-bold">Resumen:</label>

                        <textarea name="excerpt" class="form-control" rows="3"></textarea>
                    </div>


                    <div class="col-md-6 form-group">
                        <label for="info" class="text-dark font-weight-bold">Descripción:</label>

                        <textarea name="info" id="info" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="ubicacion" class="text-dark font-weight-bold">Ubicación:</label>
                        <div id="map" class="w-100" style="height:250px;"></div>
                        <label for="lat">lat: <input type="text" name="lat" id="lat" value="10.479931"></label>
                        <label for="lng">lon: <input type="text" name="lon" id="lng" value="-66.8201208"></label>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark">
                            <i class="fa fa-check"></i> Guardar Cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script>
    function initMap() {
        var latInput = document.getElementById('lat');
        var lonInput = document.getElementById('lng');
        var lat = parseFloat(latInput.value);
        var lon = parseFloat(lonInput.value);
        var mapContainer = document.getElementById('map');

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

    document.getElementById('dropzone_container').style.display = 'none'; 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\ciudadgps\resources\views/commerces/create.blade.php ENDPATH**/ ?>