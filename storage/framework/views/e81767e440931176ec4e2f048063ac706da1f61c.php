
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Lista De Usuarios
            </div>
            <div class="card-body">
                <table class="table datatable table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>E-Mail</th>
                            <th>Rol</th>
                            <th>Fecha de registro</th>
                            <th><i class="fab fa-facebook-f"></i></th>
                            <th><i class="fab fa-google"></i></th>
                            <th>Editar</th>
                            <th><input type="checkbox" name="" id=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->role); ?></td>
                            <td><?php echo e($user->created_at); ?></td>
                            <td> <?php if($user->facebook_id): ?> <i class="fas fa-check"></i> <?php endif; ?> </td>
                            <td> <?php if($user->google_id): ?> <i class="fas fa-check"></i> <?php endif; ?> </td>
                            <td>
                                <a href="/users/<?php echo e($user->id); ?>/edit" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td><input type="checkbox" name="" id=""></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/users/index.blade.php ENDPATH**/ ?>