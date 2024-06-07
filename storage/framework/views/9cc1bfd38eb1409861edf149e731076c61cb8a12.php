
<?php $__env->startSection('title'); ?>
<title>Modificar Anuncio de Empleo - CiudadGPS</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        Modificar Anuncio de Empleo
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?php echo e(url('locales-asociados/jobs/' . $job->id . '/update')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
            
                                    <div class="form-group">
                                        <label for="title" class="text-info">Cargo</label>
                                        <input type="text" class="form-control" required name="title" value="<?php echo e($job->title); ?>">
                                    </div>
            
                                    <div class="form-group">
                                        <label for="description" class="text-info">Descripción del Cargo</label>
                                        <textarea class="form-control" required name="description" rows="4"><?php echo $job->description; ?></textarea>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="user_email" class="text-info">E-Mail de Contacto:</label>
                                        <input type="email" class="form-control" required name="email" id="email" value="<?php echo e($job->email); ?>">
                                    </div>
            
                                    <div class="form-group">
                                        <label for="whatsapp" class="text-info">Whatsapp de Contacto:</label>
                                        <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="<?php echo e($job->whatsapp_number_code); ?>">
                                        <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="<?php echo e($job->whatsapp_code); ?>">
                                        <input type="hidden" name="whatsapp_number" id="whatsapp_number" value="<?php echo e($job->whatsapp_number); ?>">
                                        <input type="hidden" name="whatsapp" id="whatsapp" value="<?php echo e($job->whatsapp); ?>">
                                        <input type="text" id="whatsappFormatted" class="form-control" placeholder="412-1234567">
                                    </div>
            
                                    <button class="btn btn-fill-line">Modificar Empleo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/jobs/edit.blade.php ENDPATH**/ ?>