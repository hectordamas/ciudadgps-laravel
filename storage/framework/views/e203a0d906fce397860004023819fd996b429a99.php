
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Locales Asociados</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="section py-5">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-dark text-light">Locales Asociados</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped shop_cart_table">
                            <tbody>
                                <?php $__currentLoopData = $commerces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commerce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <img 
                                            class="border shadow"
                                            src="<?php echo e(asset($commerce->logo)); ?>" 
                                            alt="Logo <?php echo e($commerce->name); ?>" 
                                            srcset="<?php echo e(asset($commerce->logo)); ?>"
                                            width="50"
                                            height="50"
                                            style="border-radius: 100%;"
                                        />
                                    </td>
                                    <td><?php echo e($commerce->name); ?></td>
                                    <td>
                                        <div class="dropdown">
                                         <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton<?php echo e($commerce->id); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                         </button>
                                         <div class="dropdown-menu shadow border-0" aria-labelledby="dropdownMenuButton<?php echo e($commerce->id); ?>">
                                            <a class="dropdown-item" target="blank" href="<?php echo e(url('slug-comercios/' . $commerce->slug)); ?>">
                                                <i class="fas fa-store"></i> Ir al Perfil Comercial
                                            </a>
                                            <a class="dropdown-item" target="blank" href="<?php echo e(url('locales-asociados/' . $commerce->id . '/edit')); ?>">
                                                <i class="fas fa-edit"></i> Modificar Datos del Comercio
                                            </a>
                                            <a class="dropdown-item" target="blank" href="<?php echo e(url('locales-asociados/productos/' . $commerce->id)); ?>">
                                                <i class="fas fa-shopping-cart"></i> Catálogo de Productos
                                            </a>
                                            <a class="dropdown-item" target="blank" href="<?php echo e(url('locales-asociados/jobs/' . $commerce->id)); ?>">
                                                <i class="fas fa-briefcase"></i> Bolsa de Empleos
                                            </a>
                                            <a class="dropdown-item" target="blank" href="<?php echo e(url('locales-asociados/horarios/' . $commerce->id)); ?>">
                                                <i class="fas fa-clock"></i> Horarios de Atención
                                            </a>
                                            <a class="dropdown-item" target="blank" href="<?php echo e(url('locales-asociados/performance/' . $commerce->id)); ?>">
                                                <i class="fas fa-chart-bar"></i> Rendimiento del Perfil
                                            </a>
                                         </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/index.blade.php ENDPATH**/ ?>