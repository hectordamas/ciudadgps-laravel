
<?php $__env->startSection('title'); ?>
<?php
    use Carbon\Carbon;
    Carbon::setLocale('es');  
?>
<title> <?php if(isset($product)): ?> <?php echo e($product->name); ?> - CiudadGPS  <?php else: ?> Buscar en CiudadGPS <?php endif; ?></title>
<meta name="description" content="<?php echo e($meta_description); ?>" />
<meta name="keywords" content="<?php echo e($keywords); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    html{
        overflow-x: hidden;
    }
    #tooltipContainer {
      position: absolute;
      bottom: -35px;
      background-color: #000;
      color: #fff;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 14px;
      z-index: 9999;
    }
</style>


<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">

                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <img src="<?php echo e(asset($product->image)); ?>" />
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="product_title d-block"><a href="#"><?php echo e($product->name); ?></a></h4>
                            </div>
                            <div class="col-md-12">
                                <h4 class="price">$<?php echo e(number_format($product->price, 2, '.', ',')); ?></h4>
                            </div>

                            <div class="col-md-12 my-4">
                                <a href="javascript:void(0)" class="btn btn-fill-out btn-addtocart addToCart" data-commerce="<?php echo e($product->commerce_id); ?>" data-id="<?php echo e($product->id); ?>">
                                    <i class="icon-basket-loaded"></i> Agregar al Carrito
                                </a>
                                <a href="javascript:void(0)" id="copyButton" class="btn btn-dark">
                                    <i class="far fa-copy"></i> Copiar enlace
                                    <div id="tooltipContainer" style="display: none;"></div>
                                </a>
                            </div>

                            <div class="col-md-12 my-2">
                                <h5>Publicado por:</h5>
                            </div>
                            <div class="col-md-12 my-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-auto">
                                        <img src="<?php echo e(url($product->commerce->logo)); ?>" alt="<?php echo e($product->commerce->name); ?>" style="aspect-ratio: 1; width: 70px; border-radius: 50%; border: 1px solid #e9e9e9;">
                                    </div>
                                    <div class="col px-0">
                                        <div class="d-flex align-items-center">
                                            <h6><?php echo e($product->commerce->name); ?></h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="d-block"><?php echo e(Carbon::parse($product->created_at)->diffForHumans()); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 my-2">
                                <a href="/slug-comercios/<?php echo e($product->commerce->slug); ?>" class="btn btn-dark btn-sm">Ver Comercio</a>
                                <a href="/catalogo-productos/<?php echo e($product->commerce->slug); ?>"  class="btn btn-dark btn-sm mr-2">Ver Catálogo</a>
                            </div>
                        </div>
        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="large_divider clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Descripción</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab">
                                <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                                  <p><?php if($product->description): ?> <?php echo e($product->description); ?> <?php else: ?> No hay Descripción Disponible <?php endif; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script>
    $(document).ready(function() {
      $('#copyButton').click(function() {
        var link = window.location.href;
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(link).select();
        document.execCommand('copy');
        tempInput.remove();
    
        // Muestra el tooltip de confirmación
        var tooltipContainer = $('#tooltipContainer');
        tooltipContainer.text('Enlace copiado');
        tooltipContainer.fadeIn();
    
        // Oculta el tooltip después de 2 segundos
        setTimeout(function() {
          tooltipContainer.fadeOut();
        }, 2000);
      });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/products/show.blade.php ENDPATH**/ ?>