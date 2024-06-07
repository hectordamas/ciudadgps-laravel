
<?php $__env->startSection('title'); ?>
<title>Editar Categoria - CiudadGPS</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="section py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Editar Categoría
                </div>
                <form action="<?php echo e(url('locales-asociados/categories/'. $pcategory->id . '/update' )); ?>" method="POST" class="card-body">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Nombre de la Categoría</label>
                            <input type="text" required class="form-control" name="name" value="<?php echo e($pcategory->name); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-line">Modificar Información</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/products/pcategories/edit.blade.php ENDPATH**/ ?>