
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header text-dark font-weight-bold">
                    Editar Datos del Usuario #<?php echo e($user->id); ?>

                </div>
                <div class="card-body">
                    <form action="/users/<?php echo e($user->id); ?>/update" method="post" class="row">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-3 form-group">
                            <label for="name" class="font-weight-bold text-dark">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo e($user->name); ?>">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="email" class="font-weight-bold text-dark">Correo Electrónico:</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo e($user->email); ?>">
                        </div>                        
                        <div class="col-md-3 form-group">
                            <label for="role" class="font-weight-bold text-dark">Rol:</label>
                            <select name="role" id="role" class="form-control">
                                <option value="<?php echo e($user->role); ?>"><?php echo e($user->role); ?></option>
                                <?php if($user->role == 'Administrador'): ?>
                                <option value="Usuario">Usuario</option>
                                <?php else: ?>
                                <option value="Administrador">Administrador</option>
                                <?php endif; ?>
                            </select>
                        </div>                           
                        <div class="col-md-3 form-group">
                            <label for="password" class="font-weight-bold text-dark">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="Editar Usuario" class="btn btn-dark">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/users/edit.blade.php ENDPATH**/ ?>