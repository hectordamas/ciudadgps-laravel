
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Planes</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/pricing.jpeg')); ?>'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center" style="height:3vh;">
        	<div class="col-md-8">
                <div class="page-title">
            		<h3 class="text-light text-capitalize">Planes</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Planes</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<!-- STAT SECTION ABOUT --> 
<div class="section">
	<div class="container">
    	<div class="row">
            <div class="col-lg-10">
                <img src="<?php echo e(asset('assets/banner_precios.jpg')); ?>" alt="" srcset="">
            </div>
        </div>
    </div>
</div>
<!-- END SECTION ABOUT --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/pricing.blade.php ENDPATH**/ ?>