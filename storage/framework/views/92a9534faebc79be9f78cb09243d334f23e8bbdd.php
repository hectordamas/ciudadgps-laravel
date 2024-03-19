
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista de Notificaciones
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <th></th>
                        <th>Titulo</th>
                        <th>Mensaje</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pushnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($notification->created_at); ?></td>
                            <td><?php echo e($notification->title); ?></td>
                            <td><?php echo e($notification->message); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/pushnotifications/index.blade.php ENDPATH**/ ?>