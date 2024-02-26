
<title>CiudadGPS - Procesar Orden</title>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/checkout.jpg')); ?>'); background-position: center 60%; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center" style="height:10vh;">
        	<div class="col-md-8">
                <div class="page-title">
            		<h3 class="text-light text-capitalize">Procesar Orden</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light"><a href="/carrito-de-compras" class="text-light">Carrito de Compras</a></li>
                    <li class="breadcrumb-item text-light active">Procesar Orden</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START SECTION SHOP -->
<div class="section">
    <?php if(Cart::name('shopping')->countItems() > 0): ?>
	<div class="container">
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
            	<div class="heading_s1">
            		<h4>Datos del Cliente</h4>
                </div>
                <form method="post">
                    <div class="form-group">
                        <input class="form-control" id="checkoutName" required type="text" name="name" placeholder="Nombre Y Apellido *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutCedula" required type="text" name="cedula" placeholder="Cédula / DNI *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutCel" required type="text" name="cel" placeholder="Celular / Whatsapp *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutAddress" required type="text"  name="address" placeholder="Dirección *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutCity" required type="text" name="city" placeholder="Ciudad *">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="checkoutEmail" required type="text" name="email" placeholder="Correo Electrónico *">
                    </div>
                    <div class="heading_s1">
                        <h4>Información Adicional</h4>
                    </div>
                    <div class="form-group mb-0">
                        <textarea rows="5" class="form-control" id="checkoutNotes" name="notas" placeholder="Notas"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="heading_s1">
                        <h4>Tu Carrito de Compras</h4>
                    </div>
                    <div class="table-responsive order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = Cart::name('shopping')->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->getDetails()->title); ?> <span class="product-qty">x <?php echo e($item->getDetails()->quantity); ?></span></td>
                                    <td>$<?php echo e(number_format($item->getDetails()->subtotal, 2, '.', ',')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SubTotal</th>
                                    <input type="hidden" id="checkoutSubtotal" value="<?php echo e(Cart::name('shopping')->getSubtotal()); ?>">
                                    <input type="hidden" id="cartCount" value="<?php echo e(Cart::name('shopping')->countItems()); ?>">
                                    <td class="product-subtotal">$<?php echo e(number_format(Cart::name('shopping')->getSubtotal(), 2, '.', ',')); ?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="product-subtotal">$<?php echo e(number_format(Cart::name('shopping')->getTotal(), 2, '.', ',')); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <?php
                        $cartArray = [];
                        foreach (Cart::name('shopping')->getItems() as $item) {
                            array_push($cartArray, $item->getDetails());
                        }
                    ?>
                    <input type="hidden" id="datosCarrito" name="datosCarrito" value="<?php echo e(json_encode($cartArray)); ?>">
                    <input type="hidden" id="wsInput" value="<?php echo e(Session::get('whatsapp')); ?>">

                    <a href="javascript:void(0)" class="btn btn-fill-out btn-block" id="whatsappCheckout">
                        <i class="ion-social-whatsapp-outline" style="font-size:30px;"></i> Procesar Orden
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="container">
        <div class="row py-3">
            <h4>
                Tu carrito de compras está vacío
            </h4>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/public/cart/checkout.blade.php ENDPATH**/ ?>