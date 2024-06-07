
<?php $__env->startSection('title'); ?>
<title>Modificar datos del Producto - CiudadGPS</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $filteredPcategories = $product->commerce->pcategories->filter(function ($pcategory) use ($product) {
        if (isset($product->pcategory)) {
            return $pcategory->id !== $product->pcategory->id;
        } else {
            return true; // Incluir todas las categorías si $product->pcategory no está definido
        }
    });
?>
<div class="section py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Modificar Datos del Producto
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('locales-asociados/productos/'. $product->id .'/update')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="name" class="text-info">Nombre del Producto</label>
                            <input type="text" class="form-control" required name="name" value="<?php echo e($product->name); ?>">
                        </div>
    
                        <div class="form-group">
                            <label for="image" class="text-info">Imagen del Producto</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
    
                        <div class="form-group">
                            <label for="pcategory_id" class="text-info">Selecciona una Categoria</label>
                            <select name="pcategory_id" id="pcategory_id" class="form-control">
                                <?php if(isset($product->pcategory)): ?>
                                    <option value="<?php echo e($product->pcategory->id); ?>"><?php echo e($product->pcategory->name); ?></option>                                    
                                <?php else: ?>
                                    <option value="">Selecciona una Categoria</option>                                    
                                <?php endif; ?>

                                <?php $__currentLoopData = $filteredPcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pcategory->id); ?>"><?php echo e($pcategory->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="description" class="text-info">Descripción</label>
                            <input type="text" class="form-control" required name="description" value="<?php echo e($product->description); ?>">
                        </div>
    
                        <div class="form-group">
                            <label for="price" class="text-info">Precio</label>
                            <input type="number" step="any" min="1" class="form-control" name="price" id="price" value="<?php echo e($product->price); ?>" required>
                            <strong class="text-success" id="priceFormated">$<?php echo e(number_format($product->price, 2, '.', ',')); ?></strong>
                        </div>
    
    
                        <button class="btn btn-fill-line">Modificar Producto</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script>
    $(document).ready(function() {
        $('#price').on('input', function(){
            let price = $('#price').val()

            let priceFormated = new Intl.NumberFormat("es-ES", {
                style: "currency",
                currency: "USD",
            }).format(price)

            $('#priceFormated').html(priceFormated)
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/products/edit.blade.php ENDPATH**/ ?>