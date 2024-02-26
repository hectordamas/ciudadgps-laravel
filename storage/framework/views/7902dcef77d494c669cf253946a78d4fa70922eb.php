
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Lista de Anuncios
            </div>
            <div class="card-body">
                <table class="table datatable table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Banner</th>
                            <th>Sección</th>
                            <th>Posición</th>
                            <th>URL</th>
                            <th>Comercio Asociado</th>
                            <th>Oculto</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($b->id); ?></td>
                            <td><img src="<?php echo e($b->banner); ?>" width="60px"></td>
                            <td><?php echo e($b->section); ?></td>
                            <td><?php echo e($b->position); ?></td>
                            <td><?php if($b->url): ?> <a href="<?php echo e($b->url); ?>">Ver</a> <?php else: ?> N/A <?php endif; ?> </td>
                            <td><?php echo e($b->commerce_id); ?></td>
                            <td><?php if(!$b->hide): ?> <i class="fa fa-eye-slash"></i><?php endif; ?></td>
                            <td><a href="/banners/<?php echo e($b->id); ?>/edit" class="btn btn-primary"> <i class="fa fa-edit"></i> </a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/banners/index.blade.php ENDPATH**/ ?>