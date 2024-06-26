
<?php $__env->startSection('title'); ?>
<title> <?php if(isset($commerce)): ?> <?php echo e($commerce->name); ?> - CiudadGPS  <?php else: ?> Buscar en CiudadGPS <?php endif; ?></title>
<meta name="description" content="<?php echo e($meta_description); ?>" />
<meta name="keywords" content="<?php echo e($keywords); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;
    Carbon::setLocale('es');  

    $rating = 0;
    foreach ($commerce->comments as $co) {
        $rating = $rating + $co->rating;
    }
    if($commerce->comments->count() > 0){
        $rating = $rating / $commerce->comments->count();
    }

    $ratingP = $rating * 100 / 5;  

    $info = $commerce->info;
    // Eliminar todas las etiquetas HTML y dejar solo el texto plano
    $info_plano = strip_tags($info);
    // Recortar el texto a un número determinado de caracteres
    $longitud_maxima = 200;
    $resumen = substr($info_plano, 0, $longitud_maxima);
    $resumen = $resumen . '...'; 
?>

<style>
    .social_icons li{
	    padding-right: 0px;
	    margin-right: 5px;
	    margin-bottom: 3px;
	    border-radius: 5px;
    }

    .social_icons li a i{
	    color: #fff;
    }

    .youtube-container {
       position: relative;
       width: 100%;
       height: 0;
       padding-bottom: 56.25%;
    }
    .youtube-frame {
       position: absolute;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
    }
</style>

<?php if($commerce->hourEnable): ?>
    <!-- Modal -->
    <div class="modal fade" id="Horario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Horario de Atención</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-4">
                            <h6><?php echo e($day['name']); ?></h6>
                        </div>
                        <div class="col-8 text-right">
                            <?php if(($day['hour_open'] !== null && $day['minute_open'] !== null) && ($day['hour_close'] !== null && $day['minute_close'] !== null) && $day['isSelected']): ?>
                                <h6 class="text-success">
                                    <?php echo e(Carbon::now()->setHour($day['hour_open'])->setMinute($day['minute_open'])->format('g:i a')); ?>

                                    - 
                                    <?php echo e(Carbon::now()->setHour($day['hour_close'])->setMinute($day['minute_close'])->format('g:i a')); ?>

                                </h6>
                            <?php else: ?>
                                <h6 class="text-danger">
                                    Cerrado
                                </h6>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
    </div>
<?php endif; ?>

<div class="section">
    <div class="container pb-5">
    <div class="row">
        <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
            <div class="product-image">
                <div class="product_img_box">
                    <?php if($commerce->imgs->first()): ?> 
                        <img id="product_img" src="<?php echo e(asset($commerce->imgs->first()->uri)); ?>" alt="Fachada de <?php echo e($commerce->name); ?>" class="w-100" style="max-height: 450px; object-fit: cover;"/> 
                    <?php endif; ?>
                </div>
                <div id="pr_item_gallery" class="product_gallery_item slick_slider justify-content-start" data-nav="true" data-slides-to-show="7" data-slides-to-scroll="1" data-infinite="false">
                    <?php $__currentLoopData = $commerce->imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="<?php echo e(asset($img->uri)); ?>">
                            <img src="<?php echo e(asset($img->uri)); ?>" alt="Fachada de <?php echo e($commerce->name); ?> <?php echo e($img->id); ?>" class="w-100" style="max-height: 50px; object-fit: cover;"/>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7">
            <div class="pr_detail">
                <div class="product_description">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="product_title"><a href="#"><?php echo e($commerce->name); ?></a></h4>
                            <div class="product_price">
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:<?php echo e($ratingP); ?>%"></div>
                                    </div>
                                    <span class="rating_num">(<?php echo e($commerce->comments->count()); ?>)</span>
                                </div>
                            </div>        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="pr_desc d-none">
                                
                            </div>
                        </div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->likes->where('commerce_id', $commerce->id)->first()): ?>
                        <a href="javascript:void(0);" class="heart dislike" data-commerce="<?php echo e($commerce->id); ?>" data-user="<?php echo e(Auth::id()); ?>">
                            <i class="fas fa-heart" style="font-size:20px;"></i>
                        </a>
                        <?php else: ?>
                        <a href="javascript:void(0);" class="heart like" data-commerce="<?php echo e($commerce->id); ?>" data-user="<?php echo e(Auth::id()); ?>">
                            <i class="far fa-heart" style="font-size:20px;"></i>
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
                <div class="product_share">
                    <div class="mb-2">Contacto:</div>
                    <ul class="social_icons">
                        <?php if($commerce->facebook): ?>
                            <li style="background-color: #4267B2;"><a href="<?php echo e($commerce->facebook); ?>" target="blank"><i class="fab fa-facebook-f"></i></a></li>
                        <?php endif; ?>

                        <?php if($commerce->instagram): ?>
                            <li style="background: #f09433; background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
                                background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
                                background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);"><a href="<?php echo e($commerce->instagram); ?>" target="blank"><i class="fab fa-instagram"></i></a></li>
                        <?php endif; ?>

                        <?php if($commerce->twitter): ?>
                            <li style="background-color: #000000;"><a href="<?php echo e($commerce->twitter); ?>" target="blank"><img alt="X icon" src="<?php echo e(asset('assets/x-icon.webp')); ?>" width="18" height="18"></a></li>
                        <?php endif; ?>

                        <?php if($commerce->tiktok): ?>
                            <li style="background-color: #000000;"><a href="<?php echo e($commerce->tiktok); ?>" target="blank"><i class="fab fa-tiktok"></i></a></li>
                        <?php endif; ?>

                        <?php if($commerce->whatsapp): ?>
                            <li style="background-color: #25D366;"><a href="https://api.whatsapp.com/send/?phone=<?php echo e(str_replace('+', '', $commerce->whatsapp)); ?>" target="blank"><i class="fab fa-whatsapp"></i></a></li>
                        <?php endif; ?>

                        <?php if($commerce->user_email): ?>
                            <li class="bg-primary"><a href="mailto:<?php echo e($commerce->user_email); ?>" target="blank"><i class="far fa-envelope"></i></a></li>
                        <?php endif; ?>

                        <?php if($commerce->telephone): ?>
                            <li class="bg-dark"><a href="tel:<?php echo e($commerce->telephone); ?>" target="blank"><i class="fas fa-phone"></i></a></li>
                        <?php endif; ?>

                        <?php if($commerce->web): ?>
                            <li class="bg-info"><a href="<?php echo e($commerce->web); ?>" target="blank"><i class="fab fa-chrome"></i></a></li>
                        <?php endif; ?>
                    </ul>
                    
                    <?php if($commerce->user_email): ?>
                        <div class="mt-2"><i class="far fa-envelope"></i> <?php echo e($commerce->user_email); ?></div>
                    <?php endif; ?>

                    <?php if($commerce->telephone): ?>
                        <div class="mt-2"><i class="fas fa-phone"></i> <?php echo e($commerce->telephone); ?></div>
                    <?php endif; ?>
                </div>

                <?php if($commerce->url): ?>
                <div class="row py-2">
                    <div class="col-md-12">
                        <a target="blank" href="<?php echo e($commerce->url); ?>" class="btn btn-dark btn-sm">
                            <i class="fas fa-link"></i> <?php echo e($commerce->urlName); ?>

                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <ul class="product-meta">
                    <li>Categorías: <?php $__currentLoopData = $commerce->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <a href="<?php echo e(url('/comercios/slug-categorias/' . $category->slug)); ?>" class="badge badge-dark"><?php echo e($category->name); ?></a> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
                    <?php if($commerce->tags->count() > 0): ?>
                    <li>Etiquetas: <?php $__currentLoopData = $commerce->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(url('/comercios?order=id&search=' . $t->name)); ?>">#<?php echo e($t->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li><?php endif; ?>
                </ul>

            </div>
        </div>
    </div>
    

    <div class="row py-4">
        <div class="col-md-12">
            <strong>Dirección:</strong> <?php echo $commerce->address; ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="lat" id="lat" value="<?php echo e($commerce->lat); ?>">
            <input type="hidden" name="lon" id="lng" value="<?php echo e($commerce->lon); ?>">

            <div id="map1" class="w-100" style="height:300px;"></div>
        </div>
        <!-- Horarios  y Map en Desktop -->
        <div class="col-12 d-none d-md-block">
            <hr>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e($commerce->lat); ?>,<?php echo e($commerce->lon); ?>" target="blank" class="btn btn-fill-out btn-radius"><i class="fas fa-map-marked-alt"></i> Ver en Google Maps</a>

            <?php if($commerce->hourEnable): ?>
            <a href="javascript:void(0)" class="btn btn-fill-line btn-radius" data-toggle="modal" data-target="#Horario">
                <i class="far fa-clock"></i> Horarios de Atención
            </a>
            <?php endif; ?>
        </div>
        <!-- Horarios  y Map en Mobile -->
        <div class="col-12 d-block d-md-none">
            <hr>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e($commerce->lat); ?>,<?php echo e($commerce->lon); ?>" target="blank" class="btn btn-block btn-fill-out btn-radius">
                <i class="fas fa-map-marked-alt"></i> Ver en Google Maps
            </a>

            <?php if($commerce->hourEnable): ?>
            <a href="javascript:void(0)" class="btn btn-block mt-2 btn-fill-line btn-radius" data-toggle="modal" data-target="#Horario">
                <i class="far fa-clock"></i> Horarios de Atención
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="small_divider clearfix"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-style3">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Información</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Opiniones (<?php echo e($commerce->comments->count()); ?>)</a>
                    </li>
                </ul>
                <div class="tab-content shop_info_tab">
                    <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                      <?php echo nl2br(e($commerce->info))  ?? 'No hay Información Disponible'; ?>


                      <?php if($commerce->youtube): ?>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="youtube-container">
                                    <iframe class="youtube-frame" src="https://www.youtube.com/embed/<?php echo e($commerce->youtube); ?>"></iframe>
                                </div>
                            </div>
                        </div>
                      <?php endif; ?>
                    </div>
                      <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div class="comments">
                            <h5 class="product_tab_title"><?php echo e($commerce->comments->count()); ?> opiniones para <span><?php echo e($commerce->name); ?></span></h5>
                            <ul class="list_none comment_list mt-4">
                                <style>
                                    .comment_img img{
                                        width:100px; height:100px;
                                    }
                                    @media only screen and (max-width: 480px){
                                        .comment_img img {
                                            max-width: 50px;
                                            height: 50px;
                                        }
                                    }
                                </style>
                                <?php $__currentLoopData = $commerce->comments->sortByDesc('id')->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $ratingC = $commerce->comments->avg('rating') * 100 / 5;  
                                    ?>
                                    <?php if($comment->comment): ?>
                                        <li>
                                            <div class="comment_img">
                                                <img src="<?php echo e($comment->user->avatar ? $comment->user->avatar : asset('assets/user_avatar_default.png')); ?>" referrerpolicy="no-referrer" alt="<?php echo e($comment->user->name); ?> avatar" />
                                            </div>
                                            <div class="comment_block">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width:<?php echo e($ratingC); ?>%"></div>
                                                    </div>
                                                </div>
                                                <p class="customer_meta">
                                                    <span class="review_author"><?php echo e($comment->user->name); ?></span>
                                                    <span class="comment-date"><?php echo e(Carbon::parse($comment->created_at)->diffForHumans()); ?></span>
                                                </p>
                                                <div class="description">
                                                    <p><?php echo e($comment->comment); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <?php if($commerce->comments->count() > 0): ?>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <a href="<?php echo e(url('comentarios-de-comercios/' . $commerce->id)); ?>" class="btn btn-fill-line">Ver Más Opiniones</a>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(auth()->guard()->check()): ?>
                        <div class="review_form field_form">
                            <h5>Agregar una Reseña:</h5>
                            <form action="<?php echo e(url('comment/store')); ?>" class="row mt-3" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group col-12">
                                    <div class="star_rating">
                                        <span class="star" data-value="1"><i class="far fa-star"></i></span>
                                        <span class="star" data-value="2"><i class="far fa-star"></i></span> 
                                        <span class="star" data-value="3"><i class="far fa-star"></i></span>
                                        <span class="star" data-value="4"><i class="far fa-star"></i></span>
                                        <span class="star" data-value="5"><i class="far fa-star"></i></span>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <input type="hidden" name="rating" id="rating" value="1"/>
                                    <input type="hidden" name="commerce_id" id="commerce_id" value="<?php echo e($commerce->id); ?>">
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::id()); ?>">
                                    <textarea required="required" placeholder="Comentario *" name="comment" class="form-control" name="message" rows="3"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Enviar Reseña</button>
                                </div>
                            </form>
                        </div>
                        <?php else: ?>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo e(route('login')); ?>" class="btn btn-fill-out"> <i class="far fa-star"></i> Inicia Sesión para Reseñar</a>
                            </div>
                        </div>
                        <?php endif; ?>
                      </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($commerce->products->count() > 0): ?>
        <div class="row">
        	<div class="col-12">
            	<div class="small_divider"></div>
            	<div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <h4>Catálogo de Productos:</h4>
                    </div>
                    <div class="view_all">
                        <a href="<?php echo e(url('/catalogo-productos/' . $commerce->slug)); ?>" class="text_default"><i class="linearicons-power"></i> <span>Ver Todos</span></a>
                    </div>
                </div>
            </div>
        	<div class="col-12">
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="2" data-responsive='{"0":{"items": "2"}, "481":{"items": "3"}, "768":{"items": "4"}, "1199":{"items": "5"}}'>
                	<?php $__currentLoopData = $commerce->products->whereNull('hidden')->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="product shadow product_box border-0">
                            <div class="product_img" style="aspect-ratio: 1;">
                                <a href="/slug-productos/<?php echo e($product->slug); ?>" style="position: relative; height: 100%;">
                                    <img 
                                        src="<?php echo e(asset($product->image)); ?>" 
                                        alt="Imagen de producto <?php echo e($product->name); ?>" 
                                        style="object-fit: cover; height: 100%; aspect-ratio: 1;"
                                    >

                                    <a href="javascript:void(0)" data-commerce="<?php echo e($product->commerce_id); ?>" data-id="<?php echo e($product->id); ?>" class="btn btn-sm addToCart" style="background-color: rgba(0,0,0,0.5); position: absolute; top: 0; right: 0; border-radius: 0;">
                                        <i class="icon-basket-loaded text-light" style="font-size: 30px;"></i>
                                    </a>
                                </a>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="/slug-productos/<?php echo e($product->slug); ?>"><?php echo e($product->name); ?></a></h6>
                                <div class="product_price">
                                    <span class="price">$<?php echo e(number_format($product->price, 2, '.', ',')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('map'); ?>
<script>
    var latInput = document.getElementById('lat');
    var lonInput = document.getElementById('lng');
    var lat = parseFloat(latInput.value);
    var lon = parseFloat(lonInput.value);
    var mapContainer = document.getElementById('map1');

    function initMap() {
        var map = new google.maps.Map(mapContainer, {
            center: {lat: lat, lng: lon },
            zoom: 13
        });

        var marker = new google.maps.Marker({
            position: {lat: lat, lng: lon },
            map: map
        });

    }

    window.initMap = initMap;
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcWkdk6cq3cMIUqrJK36j7aErEOlWdqVo&callback=initMap">
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/commerces/show.blade.php ENDPATH**/ ?>