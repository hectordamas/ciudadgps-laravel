<?php $__env->startSection('title'); ?>
<title>Reestablece tu Cuenta</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center my-3 email-container">
        <div class="col-md-8">
            <div class="login_wrap">
                <div class="padding_eight_all bg-white">                
                
                    <div class="heading_s1">
                        <h3 class="text-center">Reestablecer Contraseña</h3>
                    </div>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo e(url('solicitarCodigo')); ?>" id="solicitarCodigo">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="exampleInputEmail" aria-describedby="emailHelp" required autocomplete="email" autofocus value="<?php echo e(old('email')); ?>"
                            placeholder="Ingrese su Correo Electrónico:">

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out btn-block">
                                    <i class="fas fa-envelope"></i> Enviar Código de Verificación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-3 d-none code-container">
        <div class="col-md-8">
            <div class="login_wrap">
                <div class="padding_eight_all bg-white">                
                
                    <div class="heading_s1">
                        <h3 class="text-center">Código de Verificación</h3>
                    </div>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo e(url('comprobarCodigo')); ?>" id="comprobarCodigo">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="number" name="code" class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="code" aria-describedby="emailHelp" required autocomplete="email" autofocus value="<?php echo e(old('email')); ?>"
                            placeholder="Ingrese su Código de Verificación:">

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out btn-block">
                                    <i class="fas fa-check"></i> Verificar Código
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>