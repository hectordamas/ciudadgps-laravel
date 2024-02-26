@extends('layouts.public')
@section('title')
<title>Lista de Favoritos</title>
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="dashboard_menu">
                <ul class="nav nav-tabs flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('mi-cuenta') }}"><i class="ti-user"></i> Mi Cuenta</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true" href="{{ url('favoritos') }}"><i class="ti-heart"></i>Favoritos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form1').submit();"><i class="ti-lock"></i>Cerrar Sesión</a>
                        <form id="logout-form1" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    
                  </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="tab-content dashboard_content">
                <div class="tab-pane active" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
					<div class="card">
                    	<div class="card-header">
                            <h3>Favoritos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row shop_container list">
                                @forelse($commerces as $c)
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
                                <div class="col-lg-12">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="/comercios/{{$c->id}}">
                                                @if($c->imgs->first())<img src="{{ $c->imgs->first()->uri }}" alt="product_img1" style="max-height: 250px;">@endif
                
                                                <div style="position: absolute; left:0; top:0; background-color:rgba(255,255,255,0.4); padding:10px; display:flex; jusitfy-content:center; align-items: center;">
                                                    <img src={{$c->logo}} style="width:60px; height:60px; border-radius:50%;">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="/comercios/{{$c->id}}">{{$c->name}}</a></h6>
                                            <div class="product_price">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width:{{$ratingP}}%"></div>
                                                    </div>
                                                    <span class="rating_num">({{$c->comments->count()}})</span>
                                                </div>
                                            </div>
                                            <div class="pr_desc">
                                                <p style="text-align: justify;">{!! $c->info !!}</p>
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
                                @empty
                                <div class="col-lg-12">
                                    <h6 class="text-center">Aún no has agregado nada a tu lista de favoritos</h6>
                                </div>
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    {{$commerces->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection