<?php
    $cartInstance = Cart::name('shopping');
    $cart = $cartInstance->getItems();
    $cartCount = $cartInstance->countItems();
    $commerceId = Session::get('commerceId');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Somos la App que te conecta, más que un directorio de comercio, la comunidad de comercios más grande de Venezuela">
<meta name="keywords" content="CiudadGPS, Venezuela, negocios, locales, comercios, categorías, restaurantes, tiendas, salud, educación, tecnología, información detallada de negocios, dirección exacta, contacto, redes sociales, directorio comercial, emprendedores, ciudadgps, Ciudad GPS, herramientas, viajes, comunicacion, plomeros, mecanicos, medicos, venezuela, caracas, lugares, Descubre, locale,s comerciales, en, todo, el, país, Accede, a, un, amplio, directorio, de, información, sobre, los, negocios, establecidos, en, Venezuela">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>CiudadGPS - Tu Comunidad de Comercios en línea.</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/animate.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/bootstrap/css/bootstrap.min.css')); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/ionicons.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/themify-icons.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/linearicons.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/flaticon.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/simple-line-icons.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/owlcarousel/css/owl.carousel.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/owlcarousel/css/owl.theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/owlcarousel/css/owl.theme.default.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/magnific-popup.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/slick.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/slick-theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/style.css?v=3')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assetsPublic/css/responsive.css')); ?>">


<!-- Google tag (gtag.js) google ads-->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11483785592">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11483785592');
</script>

<!-- Google tag (gtag.js) google analitycs-->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YE105KKB85"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YE105KKB85');
</script>
</head>

<body>
<input type="hidden" <?php if(isset($commerceId)): ?> value="<?php echo e($commerceId); ?>" <?php endif; ?> id="commerceId" />

<div class="preloader">
    <div class="loader"></div>
</div>

<!-- START HEADER -->
<header class="header_wrap fixed-top dd_dark_skin transparent_header">
    <div class="light_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="<?php echo e(asset('/assets/logo_gps_blanco.png')); ?>" style="width:100%; max-width:130px;" alt="CiudadGPS Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <?php echo $__env->make('layouts.megaMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <li><a class="nav-link nav_item" href="<?php echo e(url('registrar-comercio')); ?>">Registrar Local</a></li> 
                        <li><a class="nav-link nav_item" href="<?php echo e(url('empleos')); ?>">Empleos</a></li> 
                        <li><a class="nav-link nav_item" href="<?php echo e(url('nosotros')); ?>">Nosotros</a></li> 
                        <li><a class="nav-link nav_item" href="<?php echo e(url('planes')); ?>">Planes</a></li>
                        <li><a class="nav-link nav_item" href="<?php echo e(url('blog')); ?>">Blog</a></li> 
                        <?php if(auth()->guard()->guest()): ?>
                        <li><a class="nav-link nav_item" href="<?php echo e(route('login')); ?>">Inicia Sesión</a></li> 
                        <?php else: ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="<?php echo e(url('mi-cuenta')); ?>" data-toggle="dropdown"><?php echo e(Auth::user()->name); ?></a>
                            <div class="dropdown-menu">
                                <ul> 
                                    <?php if(Auth::user()->role == 'Administrador'): ?>
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('/administrador')); ?>">Administrador</a></li> 
                                    <?php endif; ?>
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('mi-cuenta')); ?>">Mi Cuenta</a></li> 
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('favoritos')); ?>">Favoritos</a></li> 
                                    <li>
                                        <a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">Salir</a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form action="<?php echo e(url('comercios')); ?>">
                                <input type="hidden" name="order" value="<?php echo e(session()->has('latitude') ? 'distance' : 'id'); ?>" />
                                <input type="text" name="search" placeholder="Cuéntanos. ¿Qué Estás Buscando?" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div><div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count"><?php echo e($cartCount); ?></span></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                <?php $__currentLoopData = array_slice($cart, -3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $item = $item->getDetails(); ?>
                                <li>
                                    <a href="javascript:void(0)">
                                        <?php if(isset($item->options['img'])): ?>
                                            <img src="<?php echo e($item->options['img']); ?>" alt="<?php echo e($item->title); ?>" width="70px" height="70px" style="object-fit: cover;">
                                        <?php endif; ?>
                                        <?php echo e($item->title); ?>

                                    </a>
                                    <span class="cart_quantity"><?php echo e($item->quantity); ?></span> x <span class="cart_amount">$<?php echo e(number_format($item->price, 2, '.', ',')); ?></span>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span><?php echo e(number_format($cartInstance->getSubtotal(), 2, '.', ',')); ?></p>
                                <p class="cart_buttons d-flex">
                                    <a href="<?php echo e(url('carrito-de-compras')); ?>" class="btn btn-fill-line rounded-0 view-cart btn-sm">Ver Carrito</a>
                                    <a href="<?php echo e(url('checkout')); ?>" class="btn btn-fill-out rounded-0 checkout btn-sm">Procesar Orden</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->


<!-- START SECTION BANNER -->
<div class="banner_section full_screen staggered-animation-wrap bg-dark">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow carousel_style2" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active background_bg overlay_bg_70" data-img-src="<?php echo e(asset('caracas_background.jpg')); ?>">
                <div class="banner_slide_content banner_content_inner">
                	<div class="container">
                    	<div class="row justify-content-center">
                            <div class="col-lg-10 col-md-10">
                                <div class="banner_content text_white text-left">
                                    <h1 class="staggered-animation mb-3" id="main-title" data-animation="fadeInDown" data-animation-delay="0.3s">Descubre locales comerciales en todo el país</h1>
                                    <p class="staggered-animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.4s" style="animation-delay: 0.4s; opacity: 1;">Accede a un amplio directorio de información sobre los negocios establecidos en Venezuela.</p>
                                    <div style="max-width:400px;">
                                        <form action="<?php echo e(url('comercios')); ?>" class="d-flex">
                                            <input type="hidden" name="order" value="<?php echo e(session()->has('latitude') ? 'distance' : 'id'); ?>" />
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0 bg-light">
                                                        <i class="fas fa-search text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="search" placeholder="Cuéntanos. ¿Qué Estás Buscando?" class="pl-0 form-control border-0 bg-light" style="font-size: 14px; font-family: Roboto, sans-serif;">
                                            </div>
                                        </form>

                                        <div class="row mt-4">
                                            <div class="col-5 pr-1">
                                                <a 
                                                    href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" 
                                                    target="blank">
                                                    <img 
                                                        src="<?php echo e(asset('appButtons/play_store.png')); ?>" 
                                                        alt="App Store Button" 
                                                    />
                                                </a>
                                            </div>
                                            <div class="pl-1 col-5">
                                                <a 
                                                    href="https://apps.apple.com/us/app/ciudadgps/id1643027976"
                                                    target="blank">
                                                    <img 
                                                        src="<?php echo e(asset('appButtons/app_store.png')); ?>" 
                                                        alt="App Store Button" 
                                                    />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION BANNER -->

<!-- END MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION CATEGORIES -->
<div class="section pt-0 pb-5">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            	<div class="cat_overlap radius_all_5">
                	<div class="row align-items-center">
        				<div class="col-lg-3 col-md-5">
                        	<div class="text-center text-md-left">
                                <h4>Categorías</h4>
                                <p class="mb-2">Descubre las categorías más populares en CiudadGPS</p>
                                <a href="<?php echo e(url('categorias')); ?>" class="btn btn-fill-out btn-sm btn-radius"><i class="linearicons-power"></i> Ver Más</a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-7">
                            <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "2"}, "380":{"items": "2"}, "991":{"items": "2"}, "1199":{"items": "4"}}'>
                                <?php $__currentLoopData = $catHeader->take(12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="categories_box">
                                        <a href="<?php echo e(url('comercios/slug-categorias/' . $category->slug)); ?>" class="category-link">
                                            <img src="<?php echo e(asset($category->image_url)); ?>" alt="<?php echo e($category->name); ?>" style="height:40px; width:40px; margin:auto;" class="mb-4">
                                            <span class="text-dark text-uppercase font-weight-bold" style="font-size:12px;">
                                                <?php echo e($category->name); ?>

                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CATEGORIES -->


<!-- START SECTION SHOP -->
<div class="section pt-0 pb-5">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <h4>Comercios Destacados</h4>
                    </div>
                    <div class="view_all">
                        <a href="<?php echo e(url('comercios')); ?>" class="text_default link_all"><i class="linearicons-power"></i> <span>Ver Más</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $commerces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $rating = 0;
                    foreach ($c->comments as $co) {
                        $rating = $rating + $co->rating;
                    }
                    if($c->comments->count() > 0){
                        $rating = $rating / $c->comments->count();
                    }

                    $ratingP = $rating * 100 / 5;  
                ?>
                <div class="col-md-6 col-lg-3 col-12 mb-3">
                    <div class="product_box text-center shadow border-0">
                        <div class="product_img">
                            <a href="<?php echo e(url('/slug-comercios/' . $c->slug)); ?>">
                                <?php if($c->imgs->first()): ?><img src="<?php echo e($c->imgs->first()->uri); ?>" alt="<?php echo e($c->name); ?>"><?php endif; ?>
                                <div style="position: absolute; left:0; top:0; background-color:rgba(255,255,255,0.4); padding:10px; display:flex; jusitfy-content:center; align-items: center;">
                                    <img src="<?php echo e(asset($c->logo)); ?>" alt="<?php echo e($c->name); ?> logo" style="width:60px; height:60px; border-radius:50%;">
                                </div>
                            </a>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title"><a href="<?php echo e(url('/slug-comercios/' . $c->slug)); ?>"><?php echo e($c->name); ?></a></h6>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:<?php echo e($ratingP); ?>%"></div>
                                </div>
                                <span class="rating_num">(<?php echo e($c->comments->count()); ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> 
    </div>
</div>
<!-- END SECTION SHOP -->


<!-- START SECTION SHOP -->
<div class="section pt-0 pb-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <h4>Descarga Nuestra Aplicación:</h4>
                    </div>
                </div>
            </div>
		</div>
        <div class="row shop_container d-flex justifify-content-space-between">
            <div class="col-md-6 mb-4">
                <div class="card" style="background: #202325;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <i class="fab fa-google-play text-light fa-4x"></i>
                            </div>
                            <div class="col-9 py-3">
                                <h4 class="text-light mb-4 font-weight-light"><em>Disponible en Play Store</em></h4>

                                <a href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" target="blank" class="btn btn-fill-out btn-radius btn-sm">
                                    <i class="fas fa-download"></i> Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card" style="background: #202325;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <i class="fab fa-app-store text-light fa-4x"></i>
                            </div>
                            <div class="col-9 py-3">
                                <h4 class="text-light mb-4 font-weight-light"><em>Disponible en App Store</em></h4>

                                <a href="https://apps.apple.com/app/ciudad-gps/id1643027976" target="blank" class="btn btn-fill-out btn-radius btn-sm">
                                    <i class="fas fa-download"></i> Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div> 
    </div>
</div>
<!-- END SECTION SHOP -->


</div>
<!-- END MAIN CONTENT -->

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/welcome.blade.php ENDPATH**/ ?>