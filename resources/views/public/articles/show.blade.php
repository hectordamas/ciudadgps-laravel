@extends('layouts.public')
@section('title')
<title>{{ $article->title }} - CiudadGPS</title>
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
                    <li class="breadcrumb-item text-light"><a href="{{ url('/blog') }}" class="text-light">Blog</a></li>
                    <li class="breadcrumb-item text-light active">Artículo</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<!-- STAT SECTION ABOUT --> 
<div class="section py-5">
	<div class="container">
    	<div class="row">
        	<div class="col-xl-9">
            	<div class="single_post">
                	<h2 class="blog_title">{{ $article->title }}</h2>
                    <ul class="list_none blog_meta">
                        <li><a href="#"><i class="ti-calendar"></i> {{ $article->created_at->diffForHumans() }}</a></li>
                    </ul>
                    <div class="blog_img">
                        <img src="{{  asset($article->image) }}" style="object-fit: cover; max-height: 350px;" alt="{{ $article->title }}" />
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">

                            {!! $article->content !!}

                        	<div class="blog_post_footer">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <div class="tags">
                                            @foreach($article->atags as $tag)
                                                <a href="{{ url('/search/tags/' . $tag->id) }}">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post_navigation bg_gray">
                    <div class="row align-items-center justify-content-between p-4">
                        <div class="col-6">
                            @if($previousArticle)
                            <a href="{{ url('blog/' . $previousArticle->slug ) }}">
                                <div class="post_nav post_nav_prev">
                                    <i class="ti-arrow-left"></i>
                                    <span>{{ Illuminate\Support\Str::limit($previousArticle->title, 35) }}</span>
                                </div>
                            </a>
                            @endif
                        </div>

                        <div class="col-6">
                            @if($nextArticle)
                            <a href="{{ url('blog/' . $nextArticle->slug ) }}">
                                <div class="post_nav post_nav_next">
                                    <i class="ti-arrow-right"></i>
                                    <span>{{ Illuminate\Support\Str::limit($nextArticle->title, 35) }}</span>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
				<div class="card post_author">
                	<div class="card-body">
                    	<div class="author_img">
                        	<img 
                                src="{{ $article->user->avatar }}" 
                                width="90" 
                                height="90" 
                                style="border-radius: 100%; object-fit: cover;" 
                                alt="{{ $article->user->name }}" 
                            />
                        </div>
                        <div class="author_info">
                        	<h5 class="author_name">{{ $article->user->name }}</h5>
                            <span class="d-inline-bloc font-weight-bold" style="font-size: 13px;">{{ $article->user->job_position }}</span>
                        	<p>{{ $article->user->bio }}</p>
                        </div>
                    </div>
                </div>
                <div class="related_post">
                	<div class="content_title">
                    	<h5>Artículos Relacionados</h5>
                    </div>
                    <div class="row">
                        @foreach($relatedArticles as $related)
                        <div class="col-md-6">
                            <div class="blog_post blog_style2 box_shadow1">
                                <div class="blog_img">
                                    <a href="{{ url('/blog/' . $related->slug) }}">
                                        <img src="{{ asset($related->image) }}" height="200" alt="{{ $related->title }}">
                                    </a>
                                </div>
                                <div class="blog_content bg-white">
                                    <div class="blog_text">
                                        <h5 class="blog_title"><a href="{{ url('/blog/' . $related->slug) }}">{{ Illuminate\Support\Str::limit($related->title, 60) }}</a></h5>
                                        <ul class="list_none blog_meta">
                                            <li><a href="#"><i class="ti-calendar"></i> {{ $related->created_at->diffForHumans() }}</a></li>
                                        </ul>
                                        <p>{{ Illuminate\Support\Str::limit($related->excerpt, 140) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach                   

                	</div>
                </div>

            </div>

            <div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
            	<div class="sidebar">
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
                	<div class="widget">
                    	<h5 class="widget_title">Articulos Más Recientes</h5>
                        <ul class="widget_recent_post">
                            @forelse($recentArticles as $recent)
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="{{ url('/blog/' . $recent->slug) }}">
                                            <img src="{{ url($recent->image) }}" alt="{{ $recent->title }}">
                                        </a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="{{ url('/blog/' . $recent->slug) }}">{{ Illuminate\Support\Str::limit($recent->title, 40) }}</a></h6>
                                        <p class="small m-0">{{ $recent->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li>
                                <a href="#">No hay Artículos Recientes Disponibles</a>
                            </li>
                            @endforelse
                    	</ul>
                    </div>

                	<div class="widget">
                    	<h5 class="widget_title">Etiquetas</h5>
                        <div class="tags">
                            @forelse($tags as $tag)
                        	    <a href="{{ url('/search/tags/' . $tag->id) }}" >{{ $tag->name }}</a>
                            @empty
                                <a href="#">No hay Etiquetas Disponibles</a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- END SECTION ABOUT --> 
@endsection