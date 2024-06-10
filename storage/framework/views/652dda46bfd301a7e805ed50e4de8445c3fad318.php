
<?php $__env->startSection('title'); ?>
<?php
use Illuminate\Support\Str;

?>
<title>CiudadGPS - Catálogo de Productos - <?php echo e($commerce->name); ?></title>
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
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/job_background.jpg')); ?>'); background-position: center center; background-size: cover; position: relative;">

</div>
<!-- END SECTION BREADCRUMB -->

<div class="section">

    <div class="container">
        <div class="row justify-content-center" style="margin-top: -80px;">
            <div class="col-md-12 d-flex justify-content-center my-2">
                <img class="border rounded-circle" style="width: 120px; height: 120px;" src="<?php echo e(asset($commerce->logo)); ?>" alt="<?php echo e($commerce->name); ?>">
            </div>
    
            <div class="col-md-12 d-flex justify-content-center my-2">
                <h3 class="text-center"><?php echo e($commerce->name); ?></h3>
            </div>
    
            <div class="col-md-12 d-flex justify-content-center mb-3">
                <a href="<?php echo e(url('/carrito-de-compras')); ?>" class="btn btn-sm btn-light" style="background: #e9e9e9;"> 
                    <i class="icon-basket-loaded" style="font-size: 20px;"></i>
                    Ir al Carrito
                </a>
                <a href="javascript:void(0)" id="copyButton" class="btn btn-sm btn-light" style="background: #e9e9e9;"> 
                    <i class="far fa-copy" style="font-size: 20px;"></i>
                    Copiar Enlace
                    <div id="tooltipContainer" style="display: none;"></div>
                </a>
            </div>
    
            <?php if($commerce->pcategories->count() > 0): ?>
            <div class="col-md-12 mb-4">
                <div class="tab-style1">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Todos</a>
                        </li>
                        <?php $__currentLoopData = $commerce->pcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link" id="<?php echo e(Str::slug($pcategory->name)); ?>-tab" data-toggle="tab" href="#<?php echo e(Str::slug($pcategory->name)); ?>" role="tab" aria-controls="<?php echo e(Str::slug($pcategory->name)); ?>" aria-selected="true">
                                <?php echo e($pcategory->name); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="tab_slider tab-content">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <div class="row shop_container justify-content-center">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-5 col-5 grid_item px-2">
                                <div class="product shadow product_box border-0">
                                    <div class="product_img" style="aspect-ratio: 1;">
                                        <a href="<?php echo e(url('/slug-productos/' . $product->slug)); ?>" style="position: relative; height: 100%;">
                                            <img src="<?php echo e(asset($product->image)); ?>" style="object-fit: cover; height: 100%; aspect-ratio: 1;" alt="<?php echo e($product->name); ?>">
                                        </a>
                                        
                                        <a href="javascript:void(0)" class="btn btn-sm addToCart" data-commerce="<?php echo e($product->commerce_id); ?>" data-id="<?php echo e($product->id); ?>" style="background-color: rgba(0,0,0,0.5); position: absolute; top: 0; right: 0; border-radius: 0;">
                                            <i class="icon-basket-loaded text-light" style="font-size: 30px;"></i>
                                        </a>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/slug-productos/<?php echo e($product->slug); ?>"><?php echo e($product->name); ?></a></h6>
                                        <div class="product_price">
                                            <span class="price">$<?php echo e(number_format($product->price, 2, '.', ',')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php $__currentLoopData = $commerce->pcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade" id="<?php echo e(Str::slug($pcategory->name)); ?>" role="tabpanel" aria-labelledby="<?php echo e(Str::slug($pcategory->name)); ?>-tab">
                        <div class="row shop_container justify-content-center">
                            <?php $__currentLoopData = $pcategory->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-5 col-5 grid_item px-2">
                                <div class="product shadow product_box border-0">
                                    <div class="product_img" style="aspect-ratio: 1;">
                                        <a href="<?php echo e(url('/slug-productos/' . $product->slug)); ?>" style="position: relative; height: 100%;">
                                            <img src="<?php echo e(asset($product->image)); ?>" style="object-fit: cover; height: 100%; aspect-ratio: 1;" alt="<?php echo e($product->name); ?>">
                                        </a>
                                        
                                        <a href="javascript:void(0)" class="btn btn-sm addToCart" data-commerce="<?php echo e($product->commerce_id); ?>" data-id="<?php echo e($product->id); ?>" style="background-color: rgba(0,0,0,0.5); position: absolute; top: 0; right: 0; border-radius: 0;">
                                            <i class="icon-basket-loaded text-light" style="font-size: 30px;"></i>
                                        </a>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/slug-productos/<?php echo e($product->slug); ?>"><?php echo e($product->name); ?></a></h6>
                                        <div class="product_price">
                                            <span class="price">$<?php echo e(number_format($product->price, 2, '.', ',')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
    

        </div>

    </div>

</div>
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

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/commerces/catalogo.blade.php ENDPATH**/ ?>