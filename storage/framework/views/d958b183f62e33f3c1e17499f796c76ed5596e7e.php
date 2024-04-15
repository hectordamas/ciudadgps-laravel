
<?php $__env->startSection('title'); ?>
<title>Categorías en CiudadGPS</title>
<meta name="description" content="Conoce las más de 100 categorías que tien CiudadGPS" />
<meta name="keywords" content="Afiliar, comercio, negocio, emprendimiento, bolsa de empleo, talento, personal, captacion, trabajo, venezuela, comercio electrónico, viajes, trabajo, medicina, aplicación">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/categorias.jpg')); ?>'); background-position: center center; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.7);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Todas las Categorías</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Categorías</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12">
                <div class="row">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $url = '/comercios/slug-categorias/' . $category->slug . '?order=id';
                        if(session()->has('latitude') && session()->has('longitude')){
                            $url = '/comercios/slug-categorias/' . $category->slug . '?order=distance';
                        }
                    ?>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow">
                            <div class="categories_box">
                                <a href="<?php echo e(url($url)); ?>" class="category-link">
                                    <img src="<?php echo e(asset($category->image_url)); ?>" alt="<?php echo e($category->name); ?>" style="height:40px; width:40px; margin:auto;" class="mb-4">
                                    <span class="text-dark text-uppercase font-weight-bold" style="font-size:12px;">
                                        <?php echo e($category->name); ?>

                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/categories/index.blade.php ENDPATH**/ ?>