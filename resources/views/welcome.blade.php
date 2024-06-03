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
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>CiudadGPS - Tu Comunidad de Comercios en línea.</title>

<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png?v=1') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png?v=1') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png?v=1') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png?v=1') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png?v=1') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png?v=1') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png?v=1') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png?v=1') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png?v=1') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png?v=1') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png?v=1') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png?v=1') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png?v=1') }}">
<meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png?v=1') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico?v=1') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css?v=1') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/styles.min.css?v=2') }}"><!--Estilos con iconos--->
<!-- Canonical URL -->
<?php
    $canonicalUrl = secure_url(request()->url());
    Log::info('Canonical URL for page ' . request()->path() . ': ' . $canonicalUrl);
?>
<link rel="canonical" href="{{ $canonicalUrl }}" />

</head>

<body>
<input type="hidden" @isset($commerceId) value="{{$commerceId}}" @endisset id="commerceId" />

<div class="preloader">
    <div class="loader"></div>
</div>

<!-- Home Popup Section 
    <div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>

                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center">
                        <img src="{{asset('gama-promo.jpg')}}" class="w-100" alt="" srcset="">
                    </div>
                    <div class="col-sm-6 d-flex align-items-center">
                        <div class="popup_content">
                            <div class="popup-text">
                                <div class="heading_s1">
                                    <h4>Subscribe and Get 25% Discount!</h4>
                                </div>
                                <p>Subscribe to the newsletter to receive updates about new products.</p>
                            </div>
                            <form method="post">
                                <div class="form-group">
                                	<button class="btn btn-fill-line btn-block text-uppercase rounded-0" title="Subscribe" type="submit">Call To Action</button>
                                </div>
                            </form>
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>No volver a mostrar</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
End Screen Load Popup Section --> 

<!-- START HEADER -->
<header class="header_wrap fixed-top dd_dark_skin transparent_header">
    <div class="light_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="{{ asset('/assets/logo_gps_blanco.png') }}" style="width:100%; max-width:130px;" alt="CiudadGPS Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li><a class="nav-link nav_item" href="{{url('chat')}}">Chatea con Sofia</a></li>
                        @include('layouts.megaMenu')
                        <li><a class="nav-link nav_item" href="{{ url('registrar-comercio') }}">Registrar Local</a></li> 
                        <li><a class="nav-link nav_item" href="{{ url('empleos') }}">Empleos</a></li> 
                        <li><a class="nav-link nav_item" href="{{ url('politicas-de-privacidad') }}">Privacidad</a></li> 
                        <li><a class="nav-link nav_item" href="{{ url('blog') }}">Blog</a></li> 
                        <li><a class="nav-link nav_item" href="{{ url('planes') }}">Planes</a></li>
                        @guest
                        <li><a class="nav-link nav_item" href="{{ route('login') }}">Inicia Sesión</a></li> 
                        @else
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="{{ url('mi-cuenta') }}" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu">
                                <ul> 
                                    @if(Auth::user()->role == 'Administrador')
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ url('/administrador') }}">Administrador</a></li> 
                                    @endif
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ url('mi-cuenta') }}">Mi Cuenta</a></li> 
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ url('favoritos') }}">Favoritos</a></li> 
                                    <li>
                                        <a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">Salir</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form action="{{ url('comercios') }}">
                                <input type="hidden" name="order" value="{{ session()->has('latitude') ? 'distance' : 'id'}}" />
                                <input type="text" name="search" placeholder="Cuéntanos. ¿Qué Estás Buscando?" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div><div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count">{{ $cartCount }}</span></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                @foreach(array_slice($cart, -3) as $item)
                                @php $item = $item->getDetails(); @endphp
                                <li>
                                    <a href="javascript:void(0)">
                                        @isset($item->options['img'])
                                            <img src="{{$item->options['img']}}" alt="{{$item->title}}" width="70px" height="70px" style="object-fit: cover;">
                                        @endisset
                                        {{ $item->title }}
                                    </a>
                                    <span class="cart_quantity">{{ $item->quantity }}</span> x <span class="cart_amount">${{ number_format($item->price, 2, '.', ',') }}</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span>{{ number_format($cartInstance->getSubtotal(), 2, '.', ',') }}</p>
                                <p class="cart_buttons d-flex">
                                    <a href="{{ url('carrito-de-compras') }}" class="btn btn-fill-line rounded-0 view-cart btn-sm">Ver Carrito</a>
                                    <a href="{{ url('checkout') }}" class="btn btn-fill-out rounded-0 checkout btn-sm">Procesar Orden</a>
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
            <div class="carousel-item active background_bg overlay_bg_70" data-img-src="{{ asset('caracas_background.webp') }}">
                <div class="banner_slide_content banner_content_inner">
                	<div class="container">
                    	<div class="row justify-content-center">
                            <div class="col-lg-10 col-md-10">
                                <div class="banner_content text_white text-left">
                                    <h1 class="staggered-animation mb-3" id="main-title" data-animation="fadeInDown" data-animation-delay="0.3s">Descubre locales comerciales en todo el país</h1>
                                    <p class="staggered-animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.4s" style="animation-delay: 0.4s; opacity: 1;">Accede a un amplio directorio de información sobre los negocios establecidos en Venezuela.</p>
                                    <div style="max-width:400px;">
                                        <form action="{{ url('comercios') }}" class="d-flex">
                                            <input type="hidden" name="order" value="{{ session()->has('latitude') ? 'distance' : 'id'}}" />
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
                                            <div class="col-4 pr-1">
                                                <a 
                                                    href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" 
                                                    target="blank">
                                                    <img 
                                                        src="{{ asset('appButtons/play_store.png') }}" 
                                                        alt="Botón de descarga de Google Play Store" 
                                                    />
                                                </a>
                                            </div>
                                            <div class="pl-1 col-4">
                                                <a 
                                                    href="https://apps.apple.com/us/app/ciudadgps/id1643027976"
                                                    target="blank">
                                                    <img 
                                                        src="{{ asset('appButtons/app_store.png') }}" 
                                                        alt="Botón de descarga de App Store" 
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
                                    <a href="{{ url('categorias') }}" class="btn btn-fill-out btn-sm btn-radius"><i class="linearicons-power"></i> Ver Más</a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-7">
                                <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "2"}, "380":{"items": "2"}, "991":{"items": "2"}, "1199":{"items": "4"}}'>
                                    @foreach ($catHeader->take(12) as $category)
                                    <div class="item">
                                        <div class="categories_box">
                                            <a href="{{ url('comercios/slug-categorias/' . $category->slug) }}" class="category-link">
                                                <img src="{{ asset($category->image_url) }}" alt="Icono de categoría: {{$category->name}}" style="height:40px; width:40px; margin:auto;" class="mb-4">
                                                <span class="text-dark text-uppercase font-weight-bold" style="font-size:12px;">
                                                    {{$category->name}}
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
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
    <div class="section pt-0 pb-2">
    	<div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h4 style="text-transform: none;">Directorio de Comercios</h4>
                        </div>
                        <div class="view_all">
                            <a href="{{ url('comercios') }}" class="text_default link_all"><i class="linearicons-power"></i> <strong>Leer Más</strong></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($commerces as $c)
                    @php
                        $ratingP = $c->comments->avg('rating') * 100 / 5;  
                    @endphp
                    <div class="col-md-6 col-lg-3 col-12 mb-3">
                        <div class="product_box text-center shadow border-0">
                            <div class="product_img">
                                <a href="{{ url('/slug-comercios/' . $c->slug) }}">
                                    @if($c->imgs->first())
                                        <img src="{{ asset($c->imgs->first()->uri) }}" alt="Fachada de {{$c->name}}" title="Fachada de {{$c->name}}"/>
                                    @endif
                                    <div style="position: absolute; left:0; top:0; background-color:rgba(255,255,255,0.4); padding:10px; display:flex; jusitfy-content:center; align-items: center;">
                                        <img src="{{ asset($c->logo) }}" alt="{{$c->name}} Logotipo" style="width:60px; height:60px; border-radius:50%;">
                                    </div>
                                </a>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title">
                                    <a href="{{ url('/slug-comercios/' . $c->slug) }}">{{ $c->name }}</a>
                                </h6>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{$ratingP}}%"></div>
                                    </div>
                                    <span class="rating_num">({{$c->comments->count()}})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 
        </div>
    </div>
    <!-- END SECTION SHOP -->


    <!-- Seccion de about -->
    <div class="section pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pr-lg-3 d-none d-lg-block">
                    <video 
                        onclick="this.play()"
                        preload="none"  
                        controls 
                        poster="{{ asset('assets/img/poster.jpg') }}" 
                        style="cursor: pointer; border-radius: 10px; object-fit: cover;">
                        <source 
                            src="{{ asset('assets/img/video-landing.mp4') }}" 
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="col-lg-7 pl-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading_s2">
                                <h2 class="mb-4" style="text-transform: none; font-family: poppins;">¿Qué es CiudadGPS?</h2>
                                <p class="leads mb-5">
                                    CiudadGPS surge como una plataforma innovadora que conecta negocios y consumidores de manera efectiva. Nuestro objetivo principal es facilitar la visibilidad de los productos, servicios y locales comerciales de los negocios, mientras que a los consumidores les brindamos las herramientas necesarias para encontrar lo que buscan de forma rápida y sencilla. Algunas de estas herramientas son:
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4">	
                            <div class="icon_box icon_box_style1 px-2">
                                <div class="icon">
                                    <i class="linearicons-map"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h6 style="text-transform: none; font-family: poppins, verdana;">Directorio Comercial</h6>
                                    <p class="leads">Te ayuda a encontrar comercios cercanos a tu ubicación actual.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4">	
                            <div class="icon_box icon_box_style1 px-2">
                                <div class="icon">
                                    <i class="linearicons-bag"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h6 style="text-transform: none; font-family: poppins, verdana;">Catálogo de Productos</h6>
                                    <p class="leads">Puedes realizar compras en línea por medio de WhatsApp.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">	
                            <div class="icon_box icon_box_style1 px-2">
                                <div class="icon">
                                    <i class="linearicons-briefcase"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h6 style="text-transform: none; font-family: poppins, verdana;">Bolsa de Empleos</h6>
                                    <p class="leads">Puedes ver anuncios de empleos de las empresas afiliadas.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">	
                            <div class="icon_box icon_box_style1 px-2">
                                <div class="icon">
                                    <i class="ti-time"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h6 style="text-transform: none; font-family: poppins, verdana;">Historias</h6>
                                    <p class="leads">Verás historias de 24h de duración de empresas afilidadas.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p>Si tienes una empresa, es momento de inscribirla en CiudadGPS, se parte de la comunidad de comercios más grande de América Latina.</p>
                            <a href="{{ url('registrar-comercio') }}" class="btn btn-fill-out">                                    
                                <i class="linearicons-rocket" style="font-size: 25px;"></i> Afíliate Ahora!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Seccion de about -->

    <hr>

    <!-- START SECTION SHOP -->
    <div class="section pt-5 pb-5">
        @php
            $articles = \App\Models\Article::orderBy('id', 'desc')
            ->get()
            ->take(6);   
        @endphp
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-12">
                    <div class="heading_s2 text-center">
                        <h3 class="mb-4">Nuestro Blog</h3>
                        <p class="leads">Conoce nuestros últimos <strong>artículos y noticias.</strong> Mantente al tanto de las últimas tendencias, consejos y novedades sobre cómo hacer crecer tu negocio con <strong>CiudadGPS</strong></p>
                    </div>
                </div>
    		</div>
            <div class="row shop_container d-flex justifify-content-space-between">
                @forelse ($articles as $article)
                <div class="col-xl-4 col-md-6">
                    <div class="blog_post blog_style2 box_shadow1">
                        @if(!(url('/') == 'http://localhost:8000'))
                        <div class="blog_img">
                            <a href="{{ url('blog/' . $article->slug ) }}">
                                <img src="{{  $article->image  }}" style="max-height: 200px; object-fit: cover;" alt="{{  $article->title }} Imagen del Articulo" title="{{  $article->title }} Imagen del Articulo">
                            </a>
                        </div>
                        @endif
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h6 class="blog_title"><a href="{{ url('blog/' . $article->slug ) }}">{{ Illuminate\Support\Str::limit($article->title, 60) }}</a></h6>
                                <ul class="list_none blog_meta">
                                    <li><a href="{{ url('blog/' . $article->slug  ) }}"><i class="ti-calendar"></i> {{ $article->created_at->diffForHumans() }}</a></li>
                                </ul>
                                <p>{{ Illuminate\Support\Str::limit($article->excerpt, 140) }}</p>
                            </div>
                        </div>
                    </div>
                </div>     
                @empty
                <div class="col-lg-12">
                    <h6>No hay resultados disponibles</h6>
                </div>   
                @endforelse
            </div> 
        </div>
    </div>
    <!-- END SECTION SHOP -->


    <!-- START SECTION SHOP -->
    <div class="section pt-0 pb_20">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h4>Descarga Nuestra Aplicación:</h4>
                        </div>
                        <div class="view_all">
                            <a href="https://linktr.ee/ciudadgps" target="blank" class="text_default link_all">
                                <i class="linearicons-power"></i> <strong>Enlaces</strong>
                            </a>
                        </div>
                    </div>
                </div>
    		</div>
            <div class="row shop_container d-flex justifify-content-space-between">
                <div class="col-md-6 mb-4">
                    <div class="card" style="background: #202325;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center text-center">
                                    <i class="fab fa-google-play text-light fa-4x"></i>
                                </div>
                                <div class="col-9 py-3">
                                    <h5 class="text-light mb-4 font-weight-light"><em>Disponible en Play Store</em></h5>

                                    <a href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" target="blank" class="btn btn-fill-out btn-radius btn-sm">
                                        <i class="fas fa-link"></i> Descargar
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
                                    <h5 class="text-light mb-4 font-weight-light"><em>Disponible en App Store</em></h5>

                                    <a href="https://apps.apple.com/app/ciudad-gps/id1643027976" target="blank" class="btn btn-fill-out btn-radius btn-sm">
                                        <i class="fas fa-link"></i> Descargar
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

@include('layouts.footer')

</body>
</html>