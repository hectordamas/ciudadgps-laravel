
<?php $__env->startSection('title'); ?>
<title> Registra tu negocio en CiudadGPS</title>
<meta name="description" content="Registra tu negocio en CiudadGPS: para obtener más alcance en tu zona, atraer nuevos clientes, tener tu catálogo de productos y publicar en nuestra bolsa de empleos" />
<meta name="keywords" content="Afiliar, comercio, negocio, emprendimiento, comercio electrónico, bolsa de empleo">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    if(session()->has('latitude')){
        $lat = session('latitude');
        $lon = session('longitude');
    }else{
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

        if($ipaddress == '127.0.0.0' || $ipaddress == '127.0.0.1' || $ipaddress == 'UNKNOWN'){
            try{
                $ipaddress = file_get_contents('https://api.ipify.org');
            }catch(\Exception $e){
                $ipaddress = '127.0.0.1';
            }
        }
        if(empty($ipaddress)){
            $ipaddress = '127.0.0.1';
        }
        $location = GeoIP($ipaddress);
        $lat = $location->lat;
        $lon = $location->lon;
    }
?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/yourCommerce.jpg')); ?>'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Registra tu Negocio</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Registra Tu Negocio</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>


<div class="section">
    <!-- START SECTION CONTACT
    <div class="section pt-3">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-6">
                	<div class="heading_s1">
                    	<h2 style="text-transform: none;">Únete a CiudadGPS</h2>
                    </div>
                    <p class="leads">CiudadGPS ayuda a los negocios locales a tener un mayor alcance y presencia en el mercado. Al proporcionar información detallada sobre cada negocio, los usuarios pueden conocer más sobre ellos y decidir si desean visitarlos. Además, los negocios también pueden recibir calificaciones y comentarios de los usuarios, lo que les permite mejorar su servicio y atraer a más clientes.</p>
                    <div class="field_form">
                        <form method="post" name="enq">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del Negocio *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="rif" id="rif" placeholder="RIF o Documento de Identidad *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Nombre y Apellido *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Correo Electrónico *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="hidden" name="telephone_number_code" id="telephone_number_code" value="+58">
                                    <input type="hidden" name="telephone_code" id="telephone_code" value="VE">
                                    <input type="hidden" name="telephone_number" id="telephone_number">
                                    <input type="hidden" name="telephone" id="telephone">
                                    <input type="text" id="telephoneFormatted" class="form-control" placeholder="Teléfono *">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="+58">
                                    <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="VE">
                                    <input type="hidden" name="whatsapp_number" id="whatsapp_number">
                                    <input type="hidden" name="whatsapp" id="whatsapp">
                                    <input type="text" id="whatsappFormatted" class="form-control" placeholder="WhatsApp *">
                                </div>

                                <div class="col-md-12 form-group">                    
                                    <textarea name="info" id="info" class="form-control" required rows="2" placeholder="Descripción Detallada del Negocio *"></textarea>
                                </div>

                                <div class="col-md-12 form-group">                    
                                    <textarea name="address" id="address" class="form-control" required rows="2" placeholder="Dirección Exacta *"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-fill-out">
                                        <i class="linearicons-rocket"></i> Continuar
                                     </button>                                
                                </div>
                            </div>
                        </form>		
                    </div>
                </div>
                <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                    <input type="hidden" name="lat" id="lat" value="<?php echo e($lat); ?>">
                    <input type="hidden" name="lon" id="lng" value="<?php echo e($lon); ?>">
                    <label for="" class="font-weight-bold">Agrega La Ubicación Exacta de tu Establecimiento: <span class="text-danger">*</span></label>
                    <div id="map" class="w-100" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
    END SECTION CONTACT -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="login_wrap">
                <div class="py-4 px-4 py-lg-5 px-lg-5 bg-white">
    
                    <form action="<?php echo e(route('public.commerces.store')); ?>" method="post" class="row" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
    
                        <div class="col-md-12">
                            <div class="heading_s1">
                                <h4>Registra tu Establecimiento comercial en CiudadGPS</h4>
                            </div>
                        </div>
    
                        <div class="col-md-12">
                            <p>Además de ayudar a los usuarios a encontrar comercios y locales cerca de ellos, CiudadGPS ayuda a los negocios locales a tener un mayor alcance y presencia en el mercado. Al proporcionar información detallada sobre cada negocio, los usuarios pueden conocer más sobre ellos y decidir si desean visitarlos. Además, los negocios también pueden recibir calificaciones y comentarios de los usuarios, lo que les permite mejorar su servicio y atraer a más clientes.</p>
                            <p>Para registrar tu negocio en CiudadGPS por favor rellena el siguiente formulario, luego de que lo envíes te estaremos contactando en las próximas horas para confirmar tus datos</p>
                        </div>
    
                        <div class="col-md-6 form-group">
                            <label for="name" class="font-weight-bold">Nombre del Negocio:</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="rif" class="font-weight-bold">RIF o Documento de Identidad:</label>
                            <input type="text" class="form-control" name="rif" id="rif" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="user_name" class="font-weight-bold">Nombre y Apellido:</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="user_email" class="font-weight-bold">E-Mail:</label>
                            <input type="email" class="form-control" name="user_email" id="user_email" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone" class="font-weight-bold">Teléfono</label>
                            <input type="hidden" name="telephone_number_code" id="telephone_number_code" value="+58">
                            <input type="hidden" name="telephone_code" id="telephone_code" value="VE">
                            <input type="hidden" name="telephone_number" id="telephone_number">
                            <input type="hidden" name="telephone" id="telephone">
                            <input type="text" id="telephoneFormatted" class="form-control" placeholder="412-1234567">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="whatsapp" class="font-weight-bold">WhatsApp:</label>
                            <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="+58">
                            <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="VE">
                            <input type="hidden" name="whatsapp_number" id="whatsapp_number">
                            <input type="hidden" name="whatsapp" id="whatsapp">
                            <input type="text" id="whatsappFormatted" class="form-control" placeholder="412-1234567">
                        </div>

                        <div class="col-md-12 form-group">
                            <hr>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="facebook" class="font-weight-bold">Enlace Facebook:</label>
                            <input type="text" class="form-control" name="facebook" id="facebook">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="twitter" class="font-weight-bold">Enlace Twitter:</label>
                            <input type="text" class="form-control" name="twitter" id="twitter">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="instagram" class="font-weight-bold">Enlace Instagram:</label>
                            <input type="text" class="form-control" name="instagram" id="instagram">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tiktok" class="font-weight-bold">Enlace Tiktok:</label>
                            <input type="text" class="form-control" name="tiktok" id="tiktok">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="threads" class="font-weight-bold">Enlace Threads:</label>
                            <input type="text" class="form-control" name="threads" id="threads">
                        </div>
    
    
                        <div class="col-md-6 form-group">
                            <label for="web" class="font-weight-bold">Enlace Página Web:</label>
                            <input type="text" class="form-control" name="web" id="web">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="threads" class="font-weight-bold">Enlace de Interés:</label>
                            <input type="text" class="form-control" name="url" id="url">
                        </div>
    
    
                        <div class="col-md-6 form-group">
                            <label for="web" class="font-weight-bold">Nombre de enlace de interés:</label>
                            <input type="text" class="form-control" name="urlName" id="urlName">
                        </div>
            
                        <div class="col-md-6 form-group">
                            <label for="twitter" class="font-weight-bold">Video Promocional:</label>
                            <input type="text" class="form-control" name="youtube" id="youtube" placeholder="ID de Youtube o Enlace">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="category" class="font-weight-bold">Categoría:</label>
                            <select name="categories[]" id="categories[]" multiple class="form-control js-example-tags" required>
                                <?php $__currentLoopData = $categories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="tags" class="font-weight-bold">Etiquetas: separar cada etiqueta con Enter</label>
                            <select name="tags[]" id="tags" class="form-control js-example-tags" multiple required></select>
                        </div>

                        <div class="col-md-12 form-group">
                            <hr>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="logo" class="font-weight-bold">Cargar Logo:</label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="images" class="font-weight-bold">Subir Imágenes de la fachada y el interior del local <span class="font-weight-normal">(preferiblemente horizontales con dimensiones de 640x450px)<span></label>
                            <input type="file" name="images[]" id="images" multiple class="form-control" accept="image/*">
                        </div>

            
                        <div class="col-md-6 form-group">
                            <label for="info" class="font-weight-bold">Descripción:</label>
            
                            <textarea name="info" id="info" class="form-control" required rows="6"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="address" class="font-weight-bold">Dirección:</label>
            
                            <textarea name="address" id="address" class="form-control" required rows="6"></textarea>
                        </div>
            
                        <div class="col-md-12 form-group">
                            <input type="hidden" name="lat" id="lat" value="<?php echo e($lat); ?>">
                            <input type="hidden" name="lon" id="lng" value="<?php echo e($lon); ?>">
                            <label for="ubicacion" class="font-weight-bold">Ubicación:</label>
                            <div id="map" class="w-100" style="height:300px;"></div>
                        </div>
            
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-fill-out btn-block">
                               <i class="linearicons-rocket"></i> Registrar Local
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

        google.maps.event.addListener(marker, 'drag', function(event){
            latInput.value = event.latLng.lat();
            lonInput.value = event.latLng.lng();
            lat = parseFloat(latInput.value);
            lon = parseFloat(lonInput.value);
        });
    }

</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcWkdk6cq3cMIUqrJK36j7aErEOlWdqVo&callback=initMap">
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/commerces/registrar.blade.php ENDPATH**/ ?>