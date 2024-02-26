@extends('layouts.public')
@section('title')
<title>Todos los Comentarios</title>
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
@endphp
<div class="section">
<div class="container pb-5">
    <div class="row">
        <div class="col-10">
            <div class="comments">
                <h5 class="product_tab_title">{{$commerce->comments->count()}} opiniones para <a href="/comercios/{{$commerce->id}}"><span>{{$commerce->name}}</span></a></h5>
                <ul class="list_none comment_list mt-4">
                    @foreach($commerce->comments->sortByDesc('id') as $comment)
                        @php
                            $ratingC = 0;
                            $ratingC = $comment->rating * 100 / 5;
                        @endphp
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
                    <li>
                        <div class="comment_img">
                            <img src="{{$comment->user->avatar ? $comment->user->avatar : asset('assets/user_avatar_default.png') }}" referrerpolicy="no-referrer" alt="{{$comment->user->name}}"/>
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
                    @endforeach
                    <li>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                {{$comments->links()}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
</div>

@endsection
