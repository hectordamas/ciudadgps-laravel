
<?php $__env->startSection('title'); ?>
<title>Empleos de <?php echo e($commerce->name); ?> en CiudadGPS</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!---------------------------- Crear Producto ------------------------------------------->
<div class="modal fade" id="CrearProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo e(url('locales-asociados/products/store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($commerce->id); ?>" name="commerce_id"/>

                        <div class="form-group">
                            <label for="name" class="text-info">Nombre del Producto</label>
                            <input type="text" class="form-control" required name="name">
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-info">Imagen del Producto</label>
                            <input type="file" class="form-control" required name="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-info">Descripción</label>
                            <input type="text" class="form-control" required name="description">
                        </div>

                        <div class="form-group">
                            <label for="price" class="text-info">Precio</label>
                            <input type="number" step="any" min="1" class="form-control" name="price" id="price" required>
                            <strong class="text-success" id="priceFormated"></strong>
                        </div>


                        <button class="btn btn-fill-line">Registrar Producto</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


<div class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <img 
                    src="<?php echo e(asset($commerce->logo)); ?>" 
                    alt="<?php echo e($commerce->name); ?>" 
                    width="100" 
                    height="100" 
                    style="border-radius: 100%;">

                <h6 class="mt-3">Empleos de <?php echo e($commerce->name); ?></h6>

                <a class="mt-1 btn btn-fill-line btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#CrearProductos">
                    <i class="fas fa-briefcase"></i> Registrar un Empleo
                </a>
            </div>

            <div class="col-md-12">
                <table class="table shop_cart_table table-bordered table-striped">
                    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($job->title); ?>

                            </td>
                            <td>
                                <?php echo e($job->created_at->diffForHumans()); ?>

                            </td>
                            <td>
                                <?php echo e($job->email); ?>

                            </td>
                            <td>
                                <?php echo e($job->whatsapp_number_code); ?><?php echo e($job->whatsapp_number); ?>

                            </td>
                            <td class="d-flex justify-content-center">
                                <form 
                                    method="POST"
                                    action="<?php echo e(url('locales-asociados/jobs/'. $job->id .'/destroy')); ?>" 
                                    class="mr-2 destroy-jobs">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                <a href="<?php echo e(url('locales-asociados/jobs/'. $job->id . '/edit' )); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center">
                                No has publicado Empleos aún
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>


        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/jobs/index.blade.php ENDPATH**/ ?>