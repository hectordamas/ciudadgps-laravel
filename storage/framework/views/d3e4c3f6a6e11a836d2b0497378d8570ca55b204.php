
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Empleos</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php 
    use Carbon\Carbon;
    Carbon::setLocale('es');

    $message = "¡Hola! Estoy interesado/a en la oferta laboral de ".$job->title." publicada en CiudadGPS. ¿Podemos hablar más sobre ella?";
    $whatsappLink = "https://api.whatsapp.com/send/?phone=". $job->whatsapp . "&text=" . $message; 
?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/job_background.jpg')); ?>'); background-position: center center; background-size: cover; position: relative;"></div>
<div class="section">
	<div class="container">

        <div class="row justify-content-center">
                <div class="col-md-10 mb-3">

                    <div class="card shadow border-0">

                        <div class="card-body">

                            <div class="row">

                                <a href="/jobs/<?php echo e($job->id); ?>" class="col-md-2 d-flex justify-content-center">
                                    <img src="<?php echo e($job->commerce->logo); ?>" style="width: 100px; height: 100px;" class="rounded-circle border" alt="" srcset="">
                                </a>

                                <div class="col-md-10">

                                    <h4 class="product_title">
                                        <a href="/jobs/<?php echo e($job->id); ?>"><?php echo e($job->title); ?></a>
                                    </h4>
                                    <h6><?php echo e($job->commerce->name); ?></h6>
                                    <h6><?php echo e(Carbon::parse($job->created_at)->diffForHumans()); ?></h6>
                                    <div class="content-p">
                                        <p><?php echo e($job->description); ?></p>
                                    </div>

                                    <h5>Información de Contacto:</h5>

                                    <?php if($job->email): ?>
                                        <p class="d-flex align-items-center my-3">
                                            <i class="ti-email mr-2" style="font-size:25px;"></i> <?php echo e($job->email); ?>

                                        </p>
                                    <?php endif; ?>                                
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>

                                <div class="col-md-10">
                                    <?php if($job->whatsapp): ?>
                                    <a href="<?php echo e($whatsappLink); ?>" class="btn btn-success mb-3 mr-2">
                                        <i class="ion-social-whatsapp-outline" style="font-size:30px;"></i>Contactar Vía Whatsapp
                                    </a>
                                    <?php endif; ?>
                                    <?php if($job->email): ?>
                                    <a href="mailto:<?php echo e($job->email); ?>" class="btn btn-dark mb-3 mr-2">
                                        <i class="ti-email" style="font-size:25px;"></i> Contactar Vía E-Mail
                                    </a>
                                    <?php endif; ?>                                
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\ciudadgps\resources\views/public/jobs/show.blade.php ENDPATH**/ ?>