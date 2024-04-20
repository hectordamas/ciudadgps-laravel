
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Crear Nueva Notificacion
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('pushnotifications.store')); ?>" class="row" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="col-md-8 form-group">
                        <label for="title" class="font-weight-bold">Titulo</label>
                        <input type="text" name="title" placeholder="Titulo de la Notificacion" required class="form-control" placeholder="Titulo">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="" class="font-weight-bold">Pantalla</label>
                        <select name="screen" id="screen" class="form-control">
                            <option value="">Ninguna</option>
                            <option value="Comercio">Comercio</option>
                        </select>
                    </div>

                    <div class="col-md-8 form-group">
                        <label for="" class="font-weight-bold">Mensaje</label>
                        <textarea name="message" required id="message" cols="30" rows="5" class="form-control" placeholder="Mensaje de la notificación"></textarea>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="" class="font-weight-bold">ID de Comercio</label>
                        <input type="text" class="form-control" name="commerceId" placeholder="Identificador del Comercio">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark">Crear Nueva Notificacion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/pushnotifications/create.blade.php ENDPATH**/ ?>