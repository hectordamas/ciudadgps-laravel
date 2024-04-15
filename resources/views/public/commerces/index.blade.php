@extends('layouts.public')

@section('title')
<title> 
    @if(isset($category)){{$category->name}} en CiudadGPS @else 
        @if(isset($search)){{$search}} en CiudadGPS @else Buscar en CiudadGPS @endif
    @endif
</title>
<meta name="description" content="{{ $meta_description }}" />
<meta name="keywords" content="{{ $keywords }}">
@endsection

@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/result.jpg') }}'); background-position: center center;  position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.7);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Resultados de búsqueda</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Resultados de búsqueda</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
        
            <div class="col-lg-9">
                @php
                    $orderTypes = collect([
                        ['name' => 'id', 'value' => 'Más Recientes'],
                        ['name' => 'rating', 'value' => 'Mejor Evaluados'],
                    ]);
            
                    if (session()->has('latitude') && session()->has('longitude')) {
                        $orderTypes->prepend(['name' => 'distance', 'value' => 'Distancia']);
                    }
                
                    $actualOrder = $orderTypes->where('name', $order)->first() ?: $orderTypes->first();
                @endphp
                @if(isset($category))
                <div class="row align-items-center mb-4 pb-1">
                    <form id="formOrder" action="{{ url('/comercios/slug-categorias/'. $category->slug) }}" method="get" class="col-12">
                        <div class="product_header">
                            <div class="product_header_left">
                                <h5>{{$category->name}}: {{$commerces->total()}} comercios encontrados</h5>
                            </div>
                            <div class="product_header_right">
                                <div class="custom_select">
                                    <select class="form-control form-control-sm" id="order" name="order">
                                        @isset($actualOrder)<option value="{{  $actualOrder['name'] }}">{{ $actualOrder['value'] }}</option>@endisset
                                        @foreach($orderTypes->filter(function($item) use ($actualOrder) { return $actualOrder != $item['name']; }) as $o)
                                            <option value="{{ $o['name'] }}">{{ $o['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                </div> 
                @else
                <div class="row align-items-center mb-4 pb-1">
                    <form id="formOrder" action="{{ url('/comercios') }}" class="col-12">
                        <div class="product_header">
                            <div class="product_header_left">
                                <h5>{{$commerces->total()}} comercios encontrados</h5>
                            </div>
                            <div class="product_header_right">
                                <div class="custom_select">
                                    <input type="hidden" name="search" value="{{$search}}">
                                    <select class="form-control form-control-sm" id="order" name="order">
                                        <option value="{{  $actualOrder['name'] }}">{{ $actualOrder['value'] }}</option>
                                        @foreach($orderTypes->filter(function($item) use ($order) { return $order != $item['name']; }) as $o)
                                            <option value="{{ $o['name'] }}">{{ $o['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                </div> 
                @endif
            
                <div class="row shop_container list">
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
                        
                            //Resumir info
                            $info = $c->info;
                        
                            // Eliminar todas las etiquetas HTML y dejar solo el texto plano
                            $info_plano = strip_tags($info);
                        
                            // Recortar el texto a un número determinado de caracteres
                            $longitud_maxima = 160;
                            $resumen = substr($info_plano, 0, $longitud_maxima);
                            $resumen = $resumen . '...'; 
                        @endphp
                    <div class="col-lg-12">
                        <div class="product">
                            <div class="product_img">
                                <a href="/slug-comercios/{{$c->slug}}">
                                    @if($c->imgs->first())<img src="{{ asset($c->imgs->first()->uri) }}" alt="{{$c->name}}" style="max-height: 250px;">@endif
                                
                                    <div style="position: absolute; left:0; top:0; background-color:rgba(255,255,255,0.4); padding:10px; display:flex; jusitfy-content:center; align-items: center;">
                                        <img src="{{asset($c->logo)}}" style="width:60px; height:60px; border-radius:50%;" alt="{{$c->name}} logo">
                                    </div>
                                </a>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{ url('/slug-comercios/'. $c->slug) }}">{{$c->name}}</a></h6>
                                <div class="product_price">
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:{{$ratingP}}%"></div>
                                        </div>
                                        <span class="rating_num">({{$c->comments->count()}})</span>
                                        <span class="ml-2 badge badge-danger">
                                            {{ session()->has('latitude') ? ($c->distance > 1 ? number_format($c->distance, 2, '.', ',') . ' km' : number_format($c->distance * 1000, 2, '.', ',') . ' m')  : '' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="pr_desc">
                                    <p style="text-align: justify;">{!! $resumen !!} <a href="/slug-comercios/{{$c->slug}}">Leer Más</a> </p>
                                </div>
                            
                                @auth
                                    @if(Auth::user()->likes->where('commerce_id', $c->id)->first())
                                    <a href="javascript:void(0);" class="heart dislike" data-commerce="{{$c->id}}" data-user="{{Auth::id()}}">
                                        <i class="fas fa-heart" style="font-size:20px;"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0);" class="heart like" data-commerce="{{$c->id}}" data-user="{{Auth::id()}}">
                                        <i class="far fa-heart" style="font-size:20px;"></i>
                                    </a>
                                    @endif
                                @endauth
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                
                    @if($commerces->count() < 1)
                        <div class="col-lg-12 text-center mb-3">
                            <img src="{{ asset('assets/img/not_found.png') }}" style="max-width: 350px; width:80%;">
                        </div>
                        <div class="col-lg-12">
                            <h4 class="text-center">No hay comercios relacionados con tu búsqueda</h4>
                        </div>
                    @endif
                </div>
            
            </div>
        </div>
        <div class="row justify-content-center">
            {{$commerces->appends(Request::except('page'))->links()}}
        </div>
    </div>
</div>

@endsection