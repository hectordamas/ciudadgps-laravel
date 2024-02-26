<?php
    if(isset($catHeader)){
        $catFooter = $catHeader;
    }else{
        $catFooter = App\Models\Category::all();
    }
?>
<!-- START FOOTER -->
<footer class="footer_dark">
	<div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="/"><img src="<?php echo e(asset('assets/logo_gps_blanco.png')); ?>" width="150px" alt="CiudadGPS logo light"/></a>
                        </div>
                        <p>Conectamos con tu necesidad! <br> Locales comerciales en Venezuela</p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li><a href="javascript:void(0);"><i class="ion-social-facebook" style="font-size:30px;"></i></a></li>
                            <li><a href="https://www.instagram.com/ciudadgps" target="blank"><i class="ion-social-instagram-outline" style="font-size:30px;"></i></a></li>
                            <li><a href="https://api.whatsapp.com/send?phone=584129749348" target="blank"><i class="ion-social-whatsapp-outline" style="font-size:30px;"></i></a></li>
                        </ul>
                    </div>
        		</div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Categorías:</h6>
                        <ul class="widget_links">
                            <?php $__currentLoopData = $catFooter->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="/comercios/categorias/<?php echo e($ca->id); ?>?order=id"><?php echo e($ca->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title mb-0"></h6>
                        <ul class="widget_links">
                            <?php $__currentLoopData = $catFooter->skip(5)->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="/comercios/categorias/<?php echo e($ca->id); ?>?order=id"><?php echo e($ca->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Enlaces:</h6>
                        <ul class="widget_links">
                            <li><a href="/">Inicio</a></li>
                            <li><a href="<?php echo e(url('registrar-comercio')); ?>">Registra Tu Negocio</a></li>
                                                        <li><a href="<?php echo e(url('faq')); ?>">FAQ</a></li>
                            <?php if(auth()->guard()->guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Inicia Sesión</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Regístrate</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo e(url('mi-cuenta')); ?>">Mi Cuenta</a></li>
                            <li><a href="<?php echo e(url('favoritos')); ?>">Favoritos</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Contacto</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:info@ciudadgps.com">info@ciudadgps.com</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <a href="tel:584129749348">+58 (412)974-9348</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-md-0 text-center">CiudadGPS 2022 © Todos los Derechos Reservados</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<script src="<?php echo e(url('assetsPublic/js/jquery-3.6.0.min.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/jquery/jquery.form.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/bootstrap/js/bootstrap.min.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/owlcarousel/js/owl.carousel.min.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/js/magnific-popup.min.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/js/waypoints.min.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/js/parallax.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/js/jquery.countdown.min.js')); ?>"></script> 
<script src="<?php echo e(url('assetsPublic/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/js/isotope.min.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/js/jquery.dd.min.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/js/jquery.elevatezoom.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="<?php echo e(asset('assets/vendor/datatables/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/sweetalert/sweetalert.js')); ?>"></script>
<script src="<?php echo e(url('assetsPublic/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/script.js?v=1')); ?>"></script>

<?php if(session()->has('error')): ?>
<script>
	var colorError = '#dc3545';
    Swal.fire({icon:'error', title:'Ha ocurrido un error!', text: "<?php echo e(session('error')); ?>", confirmButtonText: "OK", confirmButtonColor: colorError})
</script>
<?php endif; ?>

<?php if(session()->has('message')): ?>
<script>
    var colorSuccess = '#28a745';
    Swal.fire({icon:'success', title:'', text: "<?php echo e(session('message')); ?>", confirmButtonText: 'OK', confirmButtonColor: colorSuccess})
</script>
<?php endif; ?>

<script>
    $('#order').on('input', function(){
        $('#formOrder').submit();
    })

    $('#avatar').on('input', function(){
        var filename = $('#avatar').val().replace(/C:\\fakepath\\/i, '')
        $('#avatarCaption').html(filename);
    })
</script>

<?php echo $__env->yieldContent('stripe'); ?>

<?php echo $__env->yieldContent('map'); ?>
<?php /**PATH E:\ciudadgps\resources\views/layouts/footer.blade.php ENDPATH**/ ?>