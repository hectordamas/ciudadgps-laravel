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
<meta name="description" content="CiudadGPS que ayuda a encontrar comercios en Venezuela. Con geolocalización, ofrece detalles de negocios cercanos, categorías variadas y permite calificaciones, promoviendo interacción entre usuarios y negocios locales.">
<meta name="keywords" content="CiudadGPS, Venezuela, negocios, locales, geolocalización, comercios, categorías, restaurantes, tiendas, salud, educación, tecnología, información detallada de negocios, dirección exacta, contacto, redes sociales, directorio comercial, emprendedores, ciudadgps, Ciudad GPS, herramientas, viajes, comunicacion, plomeros, mecanicos, medicos, venezuela, caracas, lugares">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>CiudadGPS - La App que conecta. Comercios en Venezuela</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/animate.css') }}">	
<link rel="stylesheet" href="{{ asset('assetsPublic/bootstrap/css/bootstrap.min.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/linearicons.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/simple-line-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/owlcarousel/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/owlcarousel/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/owlcarousel/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/style.css?v=1') }}">
<link rel="stylesheet" href="{{ asset('assetsPublic/css/responsive.css') }}">


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
<input type="hidden" @isset($commerceId) value="{{$commerceId}}" @endisset id="commerceId" />

<div class="preloader">
    <div class="loader"></div>
</div>

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
                        <li>
                            <a class="nav-link" href="{{ url('/') }}">INICIO</a>
                        </li>
                        @include('layouts.megaMenu')
                        <li><a class="nav-link nav_item" href="{{ url('registrar-comercio') }}">Registrar Local</a></li> 
                        <li><a class="nav-link nav_item" href="{{ url('empleos') }}">Empleos</a></li> 
                        <li><a class="nav-link nav_item" href="{{ url('nosotros') }}">Nosotros</a></li> 
                        <!--<li><a class="nav-link nav_item" href="{{ url('planes') }}">Planes</a></li> -->
                        @guest
                        <li><a class="nav-link nav_item" href="{{ route('login') }}">Inicia Sesión</a></li> 
                        <li><a class="nav-link nav_item" href="{{ route('register') }}">Regístrate</a></li> 
                        @else
                        <li><a class="nav-link nav_item" href="{{ url('favoritos') }}">Favoritos</a></li> 
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="{{ url('mi-cuenta') }}" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu">
                                <ul> 
                                    @if(Auth::user()->role == 'Administrador')
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ url('/administrador') }}">Administrador</a></li> 
                                    @endif
                                    <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ url('mi-cuenta') }}">Mi Cuenta</a></li> 
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
                            <form action="{{ url('/comercios') }}">
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
            <div class="carousel-item active background_bg overlay_bg_70" data-img-src="{{ asset('caracas_background.jpg') }}">
                <div class="banner_slide_content banner_content_inner">
                	<div class="container">
                    	<div class="row justify-content-center">
                            <div class="col-lg-10 col-md-10">
                                <div class="banner_content text_white text-left">
                                    <h1 class="staggered-animation mb-3" id="main-title" data-animation="fadeInDown" data-animation-delay="0.3s">Descubre locales comerciales en todo el país</h1>
                                    <h2 class="staggered-animation" id="main-subtitle" data-animation="fadeInUp" data-animation-delay="0.4s">Accede a un amplio directorio de información sobre los negocios establecidos en Venezuela.</h2>
                                    <div style="max-width:400px;">
                                        <form action="{{ url('/comercios') }}" class="d-flex">
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
                                            <div class="col-5 pr-1">
                                                <a 
                                                    href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" 
                                                    target="blank">
                                                    <img 
                                                        src="{{ asset('appButtons/play_store.png') }}" 
                                                        alt="App Store Button" 
                                                    />
                                                </a>
                                            </div>
                                            <div class="pl-1 col-5">
                                                <a 
                                                    href="https://apps.apple.com/us/app/ciudadgps/id1643027976"
                                                    target="blank">
                                                    <img 
                                                        src="{{ asset('appButtons/app_store.png') }}" 
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
                                <a href="{{ url('categorias') }}" class="btn btn-fill-out btn-sm btn-radius"><i class="linearicons-power"></i> Ver Más</a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-7">
                            <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "2"}, "380":{"items": "2"}, "991":{"items": "2"}, "1199":{"items": "4"}}'>
                                @foreach ($catHeader->take(12) as $category)
                                @php
                                    $url = '/comercios/categorias/' . $category->id . '?order=id';
                                    if(session()->has('latitude') && session()->has('longitude')){
                                        $url = '/comercios/categorias/' . $category->id . '?order=distance';
                                    }
                                @endphp
                                <div class="item">
                                    <div class="categories_box">
                                        <a href="{{ url($url) }}" class="category-link">
                                            <img src="{{ asset($category->image_url) }}" alt="{{$category->name}}" style="height:40px; width:40px; margin:auto;" class="mb-4">
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
<div class="section pt-0 pb-5">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <h4>Comercios Destacados</h4>
                    </div>
                    <div class="view_all">
                        @php
                            $url = '/comercios?order=id&search=';
                            if(session()->has('latitude') && session()->has('longitude')){
                                $url = '/comercios?order=distance&search=';
                            }
                        @endphp
                        <a href="{{ url($url) }}" class="text_default link_all"><i class="linearicons-power"></i> <span>Ver Más</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($commerces as $c)
                @php
                    $rating = 0;
                    foreach ($c->comments as $co) {
                        $rating = $rating + $co->rating;
                    }
                    if($c->comments->count() > 0){
                        $rating = $rating / $c->comments->count();
                    }

                    $ratingP = $rating * 100 / 5;  
                @endphp
                <div class="col-md-6 col-lg-3 col-12 mb-3">
                    <div class="product_box text-center shadow border-0">
                        <div class="product_img">
                            <a href="{{ url('/comercios/' . $c->id) }}">
                                @if($c->imgs->first())<img src="{{ $c->imgs->first()->uri }}" alt="{{$c->name}}">@endif
                                <div style="position: absolute; left:0; top:0; background-color:rgba(255,255,255,0.4); padding:10px; display:flex; jusitfy-content:center; align-items: center;">
                                    <img src="{{ asset($c->logo) }}" alt="{{$c->name}} logo" style="width:60px; height:60px; border-radius:50%;">
                                </div>
                            </a>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title"><a href="{{ url('/comercios/' . $c->id) }}">{{ $c->name }}</a></h6>
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

@include('layouts.footer')

</body>
</html>