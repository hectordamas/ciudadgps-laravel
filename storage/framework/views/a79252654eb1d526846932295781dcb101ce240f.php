

<?php $__env->startSection('title'); ?>
<title> 
    <?php if(isset($category)): ?> 
        <?php echo e($category->name); ?> en CiudadGPS  
    <?php else: ?> 
        <?php if(isset($search)): ?>
            "<?php echo e($search); ?>" en CiudadGPS
        <?php else: ?>
            Buscar en CiudadGPS
        <?php endif; ?>
    <?php endif; ?>
</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/result.jpg')); ?>'); background-position: center center;  position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.7);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Resultados de búsqueda</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Resultados de búsqueda</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<div class="section">
<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-9">
            <?php
                $orderTypes = collect([
                    ['name' => 'id', 'value' => 'Más Recientes'],
                    ['name' => 'rating', 'value' => 'Mejor Evaluados'],
                ]);

                if (session()->has('latitude') && session()->has('longitude')) {
                    $orderTypes->prepend(['name' => 'distance', 'value' => 'Distancia']);
                }

                $actualOrder = $orderTypes->where('name', $order)->first() ?: $orderTypes->first();
            ?>
            <?php if(isset($category)): ?>
            <div class="row align-items-center mb-4 pb-1">
                <form id="formOrder" action="<?php echo e(url('/comercios/categorias/'. $category->id)); ?>" method="get" class="col-12">
                    <div class="product_header">
                        <div class="product_header_left">
                            <h5><?php echo e($category->name); ?>: <?php echo e($commerces->total()); ?> comercios encontrados</h5>
                        </div>
                        <div class="product_header_right">
                            <div class="custom_select">
                                <select class="form-control form-control-sm" id="order" name="order">
                                    <?php if(isset($actualOrder)): ?><option value="<?php echo e($actualOrder['name']); ?>"><?php echo e($actualOrder['value']); ?></option><?php endif; ?>
                                    <?php $__currentLoopData = $orderTypes->filter(function($item) use ($actualOrder) { return $actualOrder != $item['name']; }); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($o['name']); ?>"><?php echo e($o['value']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div> 
            <?php else: ?>
            <div class="row align-items-center mb-4 pb-1">
                <form id="formOrder" action="<?php echo e(url('/comercios')); ?>" class="col-12">
                    <div class="product_header">
                        <div class="product_header_left">
                            <h5><?php echo e($commerces->total()); ?> comercios encontrados</h5>
                        </div>
                        <div class="product_header_right">
                            <div class="custom_select">
                                <input type="hidden" name="search" value="<?php echo e($search); ?>">
                                <select class="form-control form-control-sm" id="order" name="order">
                                    <option value="<?php echo e($actualOrder['name']); ?>"><?php echo e($actualOrder['value']); ?></option>
                                    <?php $__currentLoopData = $orderTypes->filter(function($item) use ($order) { return $order != $item['name']; }); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($o['name']); ?>"><?php echo e($o['value']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div> 
            <?php endif; ?>

            <div class="row shop_container list">
                <?php $__currentLoopData = $commerces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $rating = 0;
                        foreach ($c->comments as $co) {
                            $rating = $rating + $co->rating;
                        }
                        if($c->comments->count() > 0){
                            $rating = $rating / $c->comments->count();
                        }

                        $ratingP = $rating * 100 / 5;  
                    ?>

                    <?php
                        $info = $c->info;

                        // Eliminar todas las etiquetas HTML y dejar solo el texto plano
                        $info_plano = strip_tags($info);

                        // Recortar el texto a un número determinado de caracteres
                        $longitud_maxima = 160;
                        $resumen = substr($info_plano, 0, $longitud_maxima);
                        $resumen = $resumen . '...'; 
                    ?>
                <div class="col-lg-12">
                    <div class="product">
                        <div class="product_img">
                            <a href="/comercios/<?php echo e($c->id); ?>">
                                <?php if($c->imgs->first()): ?><img src="<?php echo e($c->imgs->first()->uri); ?>" alt="<?php echo e($c->name); ?>" style="max-height: 250px;"><?php endif; ?>

                                <div style="position: absolute; left:0; top:0; background-color:rgba(255,255,255,0.4); padding:10px; display:flex; jusitfy-content:center; align-items: center;">
                                    <img src="<?php echo e($c->logo); ?>" style="width:60px; height:60px; border-radius:50%;" alt="<?php echo e($c->name); ?> logo">
                                </div>
                            </a>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title"><a href="/comercios/<?php echo e($c->id); ?>"><?php echo e($c->name); ?></a></h6>
                            <div class="product_price">
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:<?php echo e($ratingP); ?>%"></div>
                                    </div>
                                    <span class="rating_num">(<?php echo e($c->comments->count()); ?>)</span>
                                    <span class="ml-2 badge badge-danger">
                                        <?php echo e(session()->has('latitude') ? ($c->distance > 1 ? number_format($c->distance, 2, '.', ',') . ' km' : number_format($c->distance * 1000, 2, '.', ',') . ' m')  : ''); ?>

                                    </span>
                                </div>
                            </div>
                            <div class="pr_desc">
                                <p style="text-align: justify;"><?php echo $resumen; ?> <a href="/comercios/<?php echo e($c->id); ?>">Leer Más</a> </p>
                            </div>

                            <?php if(auth()->guard()->check()): ?>
                                <?php if(Auth::user()->likes->where('commerce_id', $c->id)->first()): ?>
                                <a href="javascript:void(0);" class="heart dislike" data-commerce="<?php echo e($c->id); ?>" data-user="<?php echo e(Auth::id()); ?>">
                                    <i class="fas fa-heart" style="font-size:20px;"></i>
                                </a>
                                <?php else: ?>
                                <a href="javascript:void(0);" class="heart like" data-commerce="<?php echo e($c->id); ?>" data-user="<?php echo e(Auth::id()); ?>">
                                    <i class="far fa-heart" style="font-size:20px;"></i>
                                </a>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($commerces->count() < 1): ?>
                    <div class="col-lg-12 text-center mb-3">
                        <img src="<?php echo e(asset('assets/img/not_found.png')); ?>" style="max-width: 350px; width:80%;">
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center">No hay comercios relacionados con tu búsqueda</h4>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="row justify-content-center">
        <?php echo e($commerces->appends(Request::except('page'))->links()); ?>

    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/commerces/index.blade.php ENDPATH**/ ?>