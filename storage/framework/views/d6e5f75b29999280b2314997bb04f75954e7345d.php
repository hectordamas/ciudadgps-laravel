
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista De Categorías
            </div>
            <div class="card-body" style="overflow-x: scroll; padding-right:30px;">
                <table class="datatable table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Creado</th>
                            <th>Categoría</th>
                            <th></th>
                            <th>Posición</th>
                            <th>Oculta</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($c->id); ?></td>
                                <td><?php echo e(date_format($c->created_at, 'd/m/Y')); ?></td>
                                <td><?php echo e($c->name); ?></td>
                                <td><img src="<?php echo e($c->image_url); ?>" alt="<?php echo e($c->name); ?>" width="30px"></td>
                                <td><?php echo e($c->position); ?></td>
                                <td>
                                    <?php if($c->hidden): ?> <i class="far fa-eye-slash"></i><?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('category.edit', ['category' => $c->id])); ?>" class="btn btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/categories/index.blade.php ENDPATH**/ ?>