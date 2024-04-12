
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header text-dark font-weight-bold">
                Lista de Artículos
            </div>
            <div class="card-body">
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Creado</th>
                            <th>Articulo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($article->id); ?></td>
                            <td><?php echo e($article->created_at->diffForHumans()); ?></td>
                            <td><?php echo e(Illuminate\Support\Str::limit($article->title, 100)); ?></td>
                            <td>
                                <a href="<?php echo e(url('articles/' . $article->id . '/edit')); ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/articles/index.blade.php ENDPATH**/ ?>