
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
                                    <label for="from" class="text-dark font-weight-bold">Desde:</label>
                                    <input type="date" class="form-control" name="from" id="from">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="to" class="text-dark font-weight-bold">Hasta:</label>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ciudadgps laravel\resources\views/commerces/filter.blade.php ENDPATH**/ ?>