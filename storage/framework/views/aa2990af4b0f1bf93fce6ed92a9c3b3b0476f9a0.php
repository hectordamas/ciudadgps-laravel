
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista de Comercios
            </div>
            <form class="card-body pagado" action="<?php echo e(url('action')); ?>" method="post" style="overflow-x: scroll;">
                <?php echo csrf_field(); ?>
                <div class="row text-right">
                    <div class="col-md-12 form-group">
                        <button type="submit" name="accion" value="pagado" class="btn btn-primary btn-sm">
                            <i class="fas fa-check-double"></i> Marcar como pagado                   
                        </button>

                        <button type="submit" name="accion" value="nopagado" class="btn btn-dark btn-sm">
                            <i class="fas fa-times"></i> Marcar como no pagado                   
                        </button>

                        <button type="submit" name="accion" value="eliminar" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar                  
                        </button>
                    </div>
                </div>
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Negocio</th>
                            <th>Categoría</th>
                            <th>Pago</th>
                            <th>Expiración</th>
                            <th>Pagado</th>
                            <th>Creado Por</th>
                            <th>Editar</th>
                            <th><input type="checkbox" id="checkAll" /></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $commerces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($c->created_at); ?></td>
                                <td>
                                    <?php if(!(url('/') == 'http://localhost:8000')): ?>
                                        <img 
                                            src="<?php echo $c->logo; ?>" 
                                            width="30" 
                                            height="30" 
                                            class="rounded-circle" 
                                        /> 
                                    <?php endif; ?>
                                    <div><?php echo e($c->name); ?></div>
                                </td>
                                <td>
                                    <?php if($c->categories->isNotEmpty()): ?>
                                        <?php echo e($c->categories->first()->name); ?>

                                    <?php endif; ?>
                                </td>                                
                                <td><?php echo e($c->payment); ?></td>
                                <td><?php echo e(date_format(new DateTime($c->expiration_date), 'd/m/Y')); ?></td>
                                <td><?php if($c->paid): ?> <i class="fa fa-check"></i> <?php endif; ?></td>
                                <td><?php echo e($c->created_by); ?></td>
                                <td>
                                    <a href="/commerces/<?php echo e($c->id); ?>/edit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkOne" value="<?php echo e($c->id); ?>" name="check[]"/>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/commerces/index.blade.php ENDPATH**/ ?>