@extends('layouts.public')
@section('title')
<title>Resultados para {{$search}} en CiudadGPS</title>
<meta name="description" content="Blog, articulos y noticias de CiudadGPS: tocamos temas de empleo, e-commerce, directorios de comercios, entre otras cosas" />
<meta name="keywords" content="Afiliar, comercio, negocio, emprendimiento, bolsa de empleo, talento, personal, captacion, trabajo, venezuela, comercio electrónico, viajes, trabajo, medicina, aplicación">
@endsection
@section('content')
<div class="breadcrumb_section page-title-mini" style="background-image: url('{{ asset('assets/blog.jpg') }}'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Blog</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Blog</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<!-- STAT SECTION ABOUT --> 
<div class="section py-5">
	<div class="container">

        <div class="row">
            <div class="col-lg-12">

                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="widget">
                            <div class="search_form">
                                <form method="GET" action="{{ url('search/blog') }}"> 
                                    <input required name="search" class="form-control" placeholder="Buscar..." type="text">
                                    <button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
                                        <i class="ion-ios-search-strong"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h6>Resultados para: {{$search}}</h6>
                    </div>
                </div>

                <div class="row d-flex">
                    @foreach ($articles as $article)
                    <div class="col-xl-4 col-md-6">
                        <div class="blog_post blog_style2 box_shadow1">
                            <div class="blog_img">
                                <a href="{{ url('blog/' . $article->slug ) }}">
                                    <img src="{{  $article->image  }}" height="200" alt="{{  $article->title }}">
                                </a>
                            </div>
                            <div class="blog_content bg-white">
                                <div class="blog_text">
                                    <h6 class="blog_title"><a href="{{ url('blog/' . $article->slug ) }}">{{ Illuminate\Support\Str::limit($article->title, 60) }}</a></h6>
                                    <ul class="list_none blog_meta">
                                        <li><a href="{{ url('blog/' . $article->slug  ) }}"><i class="ti-calendar"></i> {{ $article->created_at->diffForHumans() }}
                                    </ul>
                                    <p>{{ Illuminate\Support\Str::limit($article->excerpt, 140) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>        
                    @endforeach
                </div>
                

            </div>
        </div>

        
        <div class="row justify-content-center">
            {{$articles->appends(Request::except('page'))->links()}}
        </div>

    </div>
</div>
<!-- END SECTION ABOUT --> 
@endsection