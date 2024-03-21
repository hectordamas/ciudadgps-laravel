
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header text-dark font-weight-bold">
                    Buscar Comercios Por:
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('/commerces')); ?>" method="get" class="row" enctype="multipart/form-data">
                            <div class="form-group col-md-3">
                                <label for="from" class="text-dark font-weight-bold">Creado (Desde):</label>
                                <input type="date" class="form-control" name="from" id="from">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="to" class="text-dark font-weight-bold">Creado (Hasta):</label>
                                <input type="date" class="form-control" name="to" id="to" value="<?php echo e(date('Y-m-d')); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="category" class="text-dark font-weight-bold">Categoría:</label>
                                <select name="category" class="form-control select2" id="category">
                                    <option value="">Todos</option>
                                    <?php $__currentLoopData = $categories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="name" class="text-dark font-weight-bold">Nombre:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="from" class="text-dark font-weight-bold">Expirado (Desde):</label>
                                <input type="date" class="form-control" name="expirationFrom" id="expirationFrom">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="to" class="text-dark font-weight-bold">Exirado (Hasta):</label>
                                <input type="date" class="form-control" name="expirationTo" id="expirationTo">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="created_by" class="font-weight-bold text-dark">Creado Por</label>
                                <select name="created_by" id="created_by" class="form-control">
                                    <option value="">Todos</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->name); ?>"><?php echo e($user->name); ?> - <?php echo e($user->email); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="paid" class="font-weight-bold text-dark">Status</label>
                                <select name="paid" id="paid" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="paid">Pagados</option>
                                    <option value="notPaid">No Pagados</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-dark btn-larger">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/commerces/filter.blade.php ENDPATH**/ ?>