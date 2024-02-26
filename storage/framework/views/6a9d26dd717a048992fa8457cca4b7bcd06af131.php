<?php
    $catFooter = isset($catHeader) ? $catHeader : App\Models\Category::all();

    $categories = [
        [
            'title' => 'Categorías:',
            'items' => $catFooter->take(8),
        ],
        [
            'title' => '',
            'items' => $catFooter->skip(8)->take(9),
        ],
    ];

    $links = [
        ['url' => '/', 'text' => 'Inicio'],
        ['url' => url('registrar-comercio'), 'text' => 'Registra Tu Negocio'],
        ['url' => url('empleos'), 'text' => 'Empleos'],
        ['url' => url('faq'), 'text' => 'FAQ'],
        ['url' => url('nosotros'), 'text' => 'Nosotros'],
    ];
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
                        <p>Somos la App que te conecta! <br> Locales comerciales en todo el país </p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li><a href="https://www.instagram.com/ciudadgps" target="blank"><i class="ion-social-instagram-outline" style="font-size:30px;"></i></a></li>
                            <li><a href="https://api.whatsapp.com/send?phone=584129749348" target="blank"><i class="ion-social-whatsapp-outline" style="font-size:30px;"></i></a></li>
                        </ul>
                    </div>
                </div>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title"><?php echo e($category['title']); ?></h6>
                            <ul class="widget_links">
                                <?php $__currentLoopData = $category['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $url = '/comercios/categorias/' . $ca->id . '?order=id';
                                        if(session()->has('latitude') && session()->has('longitude')){
                                            $url = '/comercios/categorias/' . $ca->id . '?order=distance';
                                        }
                                    ?>
                                    <li><a href="<?php echo e(url($url)); ?>" class="category-link"><?php echo e($ca->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Enlaces:</h6>
                        <ul class="widget_links">
                            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e($link['url']); ?>"><?php echo e($link['text']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <li>
                                <i class="ion-social-whatsapp-outline" style="margin-top: -2px;"></i>
                                <a href="https://api.whatsapp.com/send?phone=584129749348">+58 (412)974-9348</a>
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
                    <p class="mb-md-0 text-center">Producciones Plus <?php echo e(date('Y')); ?> © Todos los Derechos Reservados</p>
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

<script>
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      console.log("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      $.ajax({
        url: '/save-location',
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        data: {latitude, longitude},
        success: function(response) {
            $('.category-link').each(function () {
                var href = $(this).attr('href');
                if (href.includes('?order=id')) {
                    href = href.replace('?order=id', '?order=distance');
                    $(this).attr('href', href);
                }
            });  

            $('.link_all').each(function () {
                var href = $(this).attr('href');
                if (href.includes('?order=id')) {
                    href = href.replace('?order=id', '?order=distance');
                    $(this).attr('href', href);
                }
            });
            
            $('#search-form input[name="order"]').val('distance');    
        },
        error: function(xhr, status, error) {
          console.log("Error sending geolocation to backend: " + error);
        }
      });
    }
</script>
<?php /**PATH I:\ciudadgps\resources\views/layouts/footer.blade.php ENDPATH**/ ?>