@extends('layouts.public')
@section('title')
<title> @if(isset($commerce)) {{$commerce->name}} - CiudadGPS  @else Buscar en CiudadGPS @endif</title>
<meta name="description" content="{{ $meta_description }}" />
<meta name="keywords" content="{{ $keywords }}">
@endsection
@section('content')
@php
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
@endphp

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
<div class="section">
<div class="container pb-5">
    <div class="row">
        <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
            <div class="product-image">
                <div class="product_img_box">
                    @if($commerce->imgs->first()) 
                        <img id="product_img" src="{{asset($commerce->imgs->first()->uri)}}" alt="Fachada de {{$commerce->name}}" class="w-100" style="max-height: 450px; object-fit: cover;"/> 
                    @endif
                </div>
                <div id="pr_item_gallery" class="product_gallery_item slick_slider justify-content-start" data-nav="true" data-slides-to-show="7" data-slides-to-scroll="1" data-infinite="false">
                    @foreach($commerce->imgs as $img)
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="{{asset($img->uri)}}">
                            <img src="{{asset($img->uri)}}" alt="Fachada de {{$commerce->name}} {{$img->id}}" class="w-100" style="max-height: 50px; object-fit: cover;"/>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7">
            <div class="pr_detail">
                <div class="product_description">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="product_title"><a href="#">{{$commerce->name}}</a></h4>
                            <div class="product_price">
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{$ratingP}}%"></div>
                                    </div>
                                    <span class="rating_num">({{$commerce->comments->count()}})</span>
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

                    @auth
                        @if(Auth::user()->likes->where('commerce_id', $commerce->id)->first())
                        <a href="javascript:void(0);" class="heart dislike" data-commerce="{{$commerce->id}}" data-user="{{Auth::id()}}">
                            <i class="fas fa-heart" style="font-size:20px;"></i>
                        </a>
                        @else
                        <a href="javascript:void(0);" class="heart like" data-commerce="{{$commerce->id}}" data-user="{{Auth::id()}}">
                            <i class="far fa-heart" style="font-size:20px;"></i>
                        </a>
                        @endif
                    @endauth

                </div>
                <div class="product_share">
                    <div class="mb-2">Contacto:</div>
                    <ul class="social_icons">
                        @if($commerce->facebook)
                            <li style="background-color: #4267B2;"><a href="{{$commerce->facebook}}" target="blank"><i class="fab fa-facebook-f"></i></a></li>
                        @endif

                        @if($commerce->instagram)
                            <li style="background: #f09433; background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
                                background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
                                background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);"><a href="{{$commerce->instagram}}" target="blank"><i class="fab fa-instagram"></i></a></li>
                        @endif

                        @if($commerce->twitter)
                            <li style="background-color: #000000;"><a href="{{$commerce->twitter}}" target="blank"><img alt="X icon" src="{{ asset('assets/x-icon.webp') }}" width="18" height="18"></a></li>
                        @endif

                        @if($commerce->tiktok)
                            <li style="background-color: #000000;"><a href="{{$commerce->tiktok}}" target="blank"><i class="fab fa-tiktok"></i></a></li>
                        @endif

                        @if($commerce->whatsapp)
                            <li style="background-color: #25D366;"><a href="https://api.whatsapp.com/send/?phone={{str_replace('+', '', $commerce->whatsapp)}}" target="blank"><i class="fab fa-whatsapp"></i></a></li>
                        @endif

                        @if($commerce->user_email)
                            <li class="bg-primary"><a href="mailto:{{$commerce->user_email}}" target="blank"><i class="far fa-envelope"></i></a></li>
                        @endif

                        @if($commerce->telephone)
                            <li class="bg-dark"><a href="tel:{{$commerce->telephone}}" target="blank"><i class="fas fa-phone"></i></a></li>
                        @endif

                        @if($commerce->web)
                            <li class="bg-info"><a href="{{$commerce->web}}" target="blank"><i class="fab fa-chrome"></i></a></li>
                        @endif
                    </ul>
                    
                    @if($commerce->user_email)
                        <div class="mt-2"><i class="far fa-envelope"></i> {{$commerce->user_email}}</div>
                    @endif

                    @if($commerce->telephone)
                        <div class="mt-2"><i class="fas fa-phone"></i> {{$commerce->telephone}}</div>
                    @endif
                </div>

                @if($commerce->url)
                <div class="row py-2">
                    <div class="col-md-12">
                        <a target="blank" href="{{ $commerce->url }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-link"></i> {{ $commerce->urlName }}
                        </a>
                    </div>
                </div>
                @endif

                <ul class="product-meta">
                    <li>Categorías: @foreach($commerce->categories as $category) 
                        <a href="{{ url('/comercios/slug-categorias/' . $category->slug) }}" class="badge badge-dark">{{$category->name}}</a> 
                    @endforeach</li>
                    @if($commerce->tags->count() > 0)
                    <li>Etiquetas: @foreach ($commerce->tags as $t)
                        <a href="{{ url('/comercios?order=id&search=' . $t->name) }}">#{{$t->name}}</a>
                    @endforeach</li>@endif
                </ul>

            </div>
        </div>
    </div>
    

    <div class="row py-4">
        <div class="col-md-12">
            <strong>Dirección:</strong> {!! $commerce->address !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="lat" id="lat" value="{{$commerce->lat}}">
            <input type="hidden" name="lon" id="lng" value="{{$commerce->lon}}">

            <div id="map1" class="w-100" style="height:300px;"></div>
        </div>
        <div class="col-12">
            <hr>
            <a href="https://www.google.com/maps/search/?api=1&query={{$commerce->lat}},{{$commerce->lon}}" target="blank" class="btn btn-fill-out btn-radius"><i class="fas fa-map-marked-alt"></i> Ver en Google Maps</a>
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
                      <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Opiniones ({{$commerce->comments->count()}})</a>
                    </li>
                </ul>
                <div class="tab-content shop_info_tab">
                    <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                      {!! nl2br(e($commerce->info))  ?? 'No hay Información Disponible' !!}

                      @if($commerce->youtube)
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="youtube-container">
                                    <iframe class="youtube-frame" src="https://www.youtube.com/embed/{{$commerce->youtube}}"></iframe>
                                </div>
                            </div>
                        </div>
                      @endif
                    </div>
                      <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div class="comments">
                            <h5 class="product_tab_title">{{$commerce->comments->count()}} opiniones para <span>{{$commerce->name}}</span></h5>
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
                                @foreach($commerce->comments->sortByDesc('id')->take(3) as $comment)
                                    @php
                                        $ratingC = $commerce->comments->avg('rating') * 100 / 5;  
                                    @endphp
                                    @if($comment->comment)
                                        <li>
                                            <div class="comment_img">
                                                <img src="{{$comment->user->avatar ? $comment->user->avatar : asset('assets/user_avatar_default.png') }}" referrerpolicy="no-referrer" alt="{{$comment->user->name}} avatar" />
                                            </div>
                                            <div class="comment_block">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width:{{$ratingC}}%"></div>
                                                    </div>
                                                </div>
                                                <p class="customer_meta">
                                                    <span class="review_author">{{$comment->user->name}}</span>
                                                    <span class="comment-date">{{Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                                </p>
                                                <div class="description">
                                                    <p>{{$comment->comment}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        @if($commerce->comments->count() > 0)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <a href="{{ url('comentarios-de-comercios/' . $commerce->id) }}" class="btn btn-fill-line">Ver Más Opiniones</a>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        @endif

                        @auth
                        <div class="review_form field_form">
                            <h5>Agregar una Reseña:</h5>
                            <form action="{{ url('comment/store') }}" class="row mt-3" method="post">
                                @csrf
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
                                    <input type="hidden" name="commerce_id" id="commerce_id" value="{{$commerce->id}}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
                                    <textarea required="required" placeholder="Comentario *" name="comment" class="form-control" name="message" rows="3"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Enviar Reseña</button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('login') }}" class="btn btn-fill-out"> <i class="far fa-star"></i> Inicia Sesión para Reseñar</a>
                            </div>
                        </div>
                        @endauth
                      </div>
                </div>
            </div>
        </div>
    </div>

    @if($commerce->products->count() > 0)
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
                        <a href="{{ url('/catalogo-productos/' . $commerce->slug) }}" class="text_default"><i class="linearicons-power"></i> <span>Ver Todos</span></a>
                    </div>
                </div>
            </div>
        	<div class="col-12">
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="2" data-responsive='{"0":{"items": "2"}, "481":{"items": "3"}, "768":{"items": "4"}, "1199":{"items": "5"}}'>
                	@foreach($commerce->products->whereNull('hidden')->take(8) as $product)
                    <div class="item">
                        <div class="product shadow product_box border-0">
                            <div class="product_img" style="aspect-ratio: 1;">
                                <a href="/slug-productos/{{ $product->slug }}" style="position: relative; height: 100%;">
                                    <img 
                                        src="{{ asset($product->image) }}" 
                                        alt="Imagen de producto {{$product->name}}" 
                                        style="object-fit: cover; height: 100%; aspect-ratio: 1;"
                                    >

                                    <a href="javascript:void(0)" data-commerce="{{$product->commerce_id}}" data-id="{{$product->id}}" class="btn btn-sm addToCart" style="background-color: rgba(0,0,0,0.5); position: absolute; top: 0; right: 0; border-radius: 0;">
                                        <i class="icon-basket-loaded text-light" style="font-size: 30px;"></i>
                                    </a>
                                </a>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="/slug-productos/{{ $product->slug }}">{{ $product->name }}</a></h6>
                                <div class="product_price">
                                    <span class="price">${{ number_format($product->price, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    </div>
</div>
@endsection
@section('map')
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
@endsection