<!DOCTYPE html>
<html lang="es">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php echo $__env->yieldContent('title'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="CiudadGPS es una aplicación desarrollada para ayudar a las personas a encontrar comercios y locales cerca de su ubicación en Venezuela. Conecta con las necesidades del usuario y les ayuda a encontrar negocios establecidos en el país, ofreciendo una amplia variedad de categorías de negocios, como restaurantes, tiendas, salud, educación, tecnología y más.
La aplicación cuenta con una interfaz fácil de usar, lo que permite a los usuarios navegar fácilmente para encontrar lo que están buscando. Además, ofrece información detallada sobre cada negocio, incluyendo la dirección exacta, contacto, redes sociales y toda la información necesaria para resolver cualquier necesidad. Los usuarios también tienen la opción de buscar comercios cerca de su ubicación, agregarlos a sus favoritos, calificar el servicio y dejar comentarios.
Una de las características más valiosas de CiudadGPS es la capacidad de buscar comercios cerca de su ubicación actual. Esta función utiliza la tecnología de geolocalización para determinar la ubicación del usuario y mostrar los negocios cercanos, lo que hace que sea muy fácil encontrar lo que se está buscando. Los usuarios también pueden filtrar los resultados de búsqueda por categoría para encontrar rápidamente lo que están buscando.
Además de ayudar a los usuarios a encontrar comercios y locales cerca de ellos, CiudadGPS también ayuda a los negocios locales a tener un mayor alcance y presencia en el mercado. Al proporcionar información detallada sobre cada negocio, los usuarios pueden conocer más sobre ellos y decidir si desean visitar o no. Además, los negocios también pueden recibir calificaciones y comentarios de los usuarios, lo que les permite mejorar su servicio y atraer a más clientes.
En resumen, CiudadGPS es una aplicación práctica y útil para aquellos que buscan tener una mejor experiencia en su ciudad, facilitando el acceso a información de negocios locales cercanos a su ubicación, además de ayudar a los negocios locales a tener un mayor alcance y presencia en el mercado, lo que es una herramienta valiosa para todos aquellos que buscan tener una mejor experiencia en su ciudad.">
<meta name="keywords" content="CiudadGPS, Venezuela, negocios locales, geolocalización, comercios cercanos, categorías de negocios, restaurantes, tiendas, salud, educación, tecnología, información detallada de negocios, dirección exacta, contacto, redes sociales">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/animate.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/bootstrap/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/ionicons.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/themify-icons.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/linearicons.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/flaticon.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/simple-line-icons.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/owlcarousel/css/owl.carousel.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/owlcarousel/css/owl.theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/owlcarousel/css/owl.theme.default.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/magnific-popup.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/jquery-ui.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/slick.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/slick-theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assetsPublic/css/responsive.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('style.css')); ?>">
<link href="<?php echo e(asset('assets/vendor/datatables/dataTables.bootstrap4.css')); ?>" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
<style>
    .preloader {
        position: fixed;
        left: 0;
        op: 0;
        z-index: 99999;
        height: 100%;
        width: 100%;
        background: #fff;
        display: flex;
    }

    .loader {
        border: 5px solid #ff373a;
        border-top-color: #ffffff;
        width: 60px;
        height: 60px;
        position: relative;
        margin: auto;
        border-radius: 50%;
        animation-name: rotate;
        animation-duration: .8s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    .product_img::before {
        display: none;
    }

    @keyframes rotate{
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>

</head>

<body>

<!-- START HEADER -->
<header class="header_wrap fixed-top header_with_topbar shadow-sm">
    <div class="bottom_header dark_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <img class="logo_light" src="<?php echo e(asset('assets/logo_ciudadgps_color.png')); ?>" style="width:100%; max-width:180px;" alt="CiudadGPS Logo" />
                    <img class="logo_dark" src="<?php echo e(asset('assets/logo_ciudadgps_color.png')); ?>" style="width:100%; max-width:180px;" alt="CiudadGPS Logo Dark" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link" href="<?php echo e(url('/')); ?>">INICIO</a>
                        </li>
                        <li class="dropdown dropdown-mega-menu">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">CATEGORÍAS</a>
                            <div class="dropdown-menu" style="margin-top:-15px;">
                                <ul class="mega-menu d-lg-flex">
                                    <li class="mega-menu-col col-lg-3">
                                        <ul> 
                                            <?php
                                                $catHeader = App\Models\Category::all();
                                            ?>
                                            <?php $__currentLoopData = $catHeader->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('/comercios/categorias/' . $cat->id . '?order=id')); ?>"><?php echo e($cat->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                    <li class="mega-menu-col col-lg-3">
                                        <ul>
                                            <?php $__currentLoopData = $catHeader->skip(8)->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('/comercios/categorias/' . $cat->id . '?order=id')); ?>"><?php echo e($cat->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                    <li class="mega-menu-col col-lg-3">
                                        <ul>
                                            <?php $__currentLoopData = $catHeader->skip(16)->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('/comercios/categorias/' . $cat->id . '?order=id')); ?>"><?php echo e($cat->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                    <li class="mega-menu-col col-lg-3">
                                        <ul>
                                            <?php $__currentLoopData = $catHeader->skip(24)->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('/comercios/categorias/' . $cat->id . '?order=id')); ?>"><?php echo e($cat->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="d-lg-flex menu_banners">
                                    <?php $__currentLoopData = \App\Models\Banner::all()->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-3">
                                        <a href="<?php echo e($b->url ? $b->url : '/comercios/' . $b->commerce_id); ?>" class="header-banner">
                                            <img src="<?php echo e($b->banner); ?>" style="width:100%;">
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </li>
                        <li><a class="nav-link nav_item" href="<?php echo e(url('registrar-comercio')); ?>">Registra Tu Negocio</a></li> 
                        <li><a class="nav-link nav_item" href="<?php echo e(url('faq')); ?>">FAQ</a></li> 
                        <?php if(auth()->guard()->guest()): ?>
                        <li><a class="nav-link nav_item" href="<?php echo e(route('login')); ?>">Inicia Sesión</a></li> 
                        <li><a class="nav-link nav_item" href="<?php echo e(route('register')); ?>">Regístrate</a></li> 
                        <?php else: ?>
                        <li><a class="nav-link nav_item" href="<?php echo e(url('favoritos')); ?>">Favoritos</a></li> 
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="<?php echo e(url('mi-cuenta')); ?>" data-toggle="dropdown"><?php echo e(Auth::user()->name); ?></a>
                            <div class="dropdown-menu">
                                <ul> 
                                    <?php if(Auth::user()->role == 'Administrador'): ?>
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('/administrador')); ?>">Administrador</a></li> 
                                    <?php endif; ?>
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url('mi-cuenta')); ?>">Mi Cuenta</a></li> 
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
                            <form action="<?php echo e(url('/comercios')); ?>">
                                <input type="hidden" name="order" value="id" />
                                <input type="text" name="search" placeholder="Buscar Establecimiento" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div><div class="search_overlay"></div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->


<!-- START MAIN CONTENT -->
<div class="main_content">

    <?php echo $__env->yieldContent('content'); ?>

</div>
<!-- END MAIN CONTENT -->

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH E:\ciudadgps\resources\views/layouts/public.blade.php ENDPATH**/ ?>