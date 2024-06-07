
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Productos</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!--------------------------- Lista de Categorias ------------------------------------------>
<div class="modal fade" id="Categorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Todas Las Categorías</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered shop_cart_table">
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($pcategory->name); ?></td>
                                <td class="d-flex justify-content-center">
                                    <form 
                                        method="POST"
                                        action="<?php echo e(url('locales-asociados/categories/'. $pcategory->id .'/destroy')); ?>" 
                                        class="mr-2 destroy-pcategory">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                    <a href="<?php echo e(url('locales-asociados/categories/'. $pcategory->id . '/edit' )); ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-center">Aun no has creado categorias</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


<!--------------------------- Crear Categoria ------------------------------------------>
<div class="modal fade" id="CrearCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo e(url('locales-asociados/categories/store')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($commerce->id); ?>" name="commerce_id"/>

                        <div class="form-group">
                            <label for="name">Nombre de la Categoria</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <button class="btn btn-fill-line">Registrar Categoria</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


<!---------------------------- Crear Producto ------------------------------------------->
<div class="modal fade" id="CrearProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo e(url('locales-asociados/products/store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($commerce->id); ?>" name="commerce_id"/>

                        <div class="form-group">
                            <label for="name" class="text-info">Nombre del Producto</label>
                            <input type="text" class="form-control" required name="name">
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-info">Imagen del Producto</label>
                            <input type="file" class="form-control" required name="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="pcategory_id" class="text-info">Selecciona una Categoria</label>
                            <select name="pcategory_id" id="pcategory_id" class="form-control">
                                <option value="">Selecciona una Categoria</option>
                                <?php $__currentLoopData = $pcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pcategory->id); ?>"><?php echo e($pcategory->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-info">Descripción</label>
                            <input type="text" class="form-control" required name="description">
                        </div>

                        <div class="form-group">
                            <label for="price" class="text-info">Precio</label>
                            <input type="number" step="any" min="1" class="form-control" name="price" id="price" required>
                            <strong class="text-success" id="priceFormated"></strong>
                        </div>


                        <button class="btn btn-fill-line">Registrar Producto</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center pb-3">
                <img src="<?php echo e(url($commerce->logo)); ?>" alt="Logo <?php echo e($commerce->name); ?>" width="80" height="80" class="shadow" style="border-radius: 100%;">
            </div>
            <div class="col-md-12 pb-2">
                <h6 class="text-center">Gestiona tus Productos en <?php echo e($commerce->name); ?></h6>
            </div>
            <div class="col-md-12 pb-3 text-center">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        <?php if($commerce->enable): ?> 
                            checked
                        <?php endif; ?>
                        type="checkbox" 
                        value="active" 
                        id="enable"
                    >
                    <input type="hidden" value="<?php echo e($commerce->id); ?>" id="commerce_id" />
                    <label class="form-check-label" for="activarCatalogo">
                      Activar Catálogo
                    </label>
                </div>
            </div>
            <div class="col-md-12 pb-3 d-block text-center d-lg-flex justify-content-center">
                <a href="<?php echo e(url('slug-comercios/' . $commerce->slug)); ?>" target="_blank" class="btn btn-sm btn-fill-line mr-2">
                    <i class="fas fa-store"></i> Ir al Perfil Comercial
                </a>

                <div class="dropdown mr-2">
                    <button class="mt-1 btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton<?php echo e($commerce->id); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list"></i> Categorías
                    </button>
                    <div class="mt-1 dropdown-menu shadow border-0" aria-labelledby="dropdownMenuButton<?php echo e($commerce->id); ?>">
                       <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#Categorias">
                            <i class="fas fa-list"></i> Lista de Categorías
                       </a>
                       <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#CrearCategorias">
                            <i class="far fa-plus-square"></i> Crear Categoria                      
                        </a>
                    </div>
                </div>

                <a class="mt-1 btn btn-sm btn-fill-line" href="javascript:void(0)" data-toggle="modal" data-target="#CrearProductos">
                    <i class="fas fa-box-open"></i> Registrar un Producto
                </a>
            </div>

            <div class="col-md-12 pb-3">
                <table class="table table-bordered table-striped shop_cart_table">
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(asset($product->image)); ?>" target="_blank">
                                    <img 
                                        class="border shadow"
                                        src="<?php echo e(asset($product->image)); ?>" 
                                        alt="Producto: <?php echo e($product->name); ?>" 
                                        width="50"
                                        height="50"
                                    />
                                </a>
                            </td>
                            <td><?php echo e($product->name); ?></td>
                            <td class="text-success font-weight-bold">$<?php echo e(number_format($product->price, 2, '.', ',')); ?></td>
                            <td class="d-flex justify-content-center">
                                <form 
                                        method="POST"
                                        action="<?php echo e(url('locales-asociados/productos/'. $product->id .'/destroy')); ?>" 
                                        class="mr-2 destroy-product">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                
                                <a href="<?php echo e(url('locales-asociados/productos/' . $product->id . '/edit')); ?>" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center">
                                No has creado productos aún
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script>
    $(document).ready(function() {
        $('#enable').on('change', function() {
            var formData = new FormData();
            formData.append('enable', $('#enable').is(':checked') ? 'active' : 'inactive');
            formData.append('commerce_id', $('#commerce_id').val());
            console.log($('#enable').is(':checked'))
            $.ajax({
                url: "<?php echo e(url('locales-asociados/setIsEnable')); ?>",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response)
                },
                error: function(xhr) {
                    console.error('Error en la solicitud:', xhr);
                }
            });
        });

        $('#price').on('input', function(){
            let price = $('#price').val()

            let priceFormated = new Intl.NumberFormat("es-ES", {
                style: "currency",
                currency: "USD",
            }).format(price)

            $('#priceFormated').html(priceFormated)
        })

        $('.destroy-product').on('submit', function(){
            if(confirm('Estás seguro de eliminar este producto?, los cambios serán irreversibles')){
                return true
            }else{
                return false
            }
        })

        $('.destroy-pcategory').on('submit', function(){
            if(confirm('Estás seguro de eliminar esta categoria?, los cambios serán irreversibles')){
                return true
            }else{
                return false
            }
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/products/index.blade.php ENDPATH**/ ?>