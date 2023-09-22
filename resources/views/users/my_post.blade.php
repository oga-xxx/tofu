@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>マイポスト</h1>

        <hr>

        @foreach($posts as $post)
        <div class="card" style="width: 20rem;">
            @if ($post->image !== "")
            <img src="{{ asset("storage/" . $post->image) }}" alt=“料理の画像” class="card-img-top">
            @else
            <img src="{{ asset('img/no_image.png')}}" alt=“料理の画像” class="card-img-top">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{!! nl2br(e(Str::limit($post->content, 30))) !!}</p>
                @auth
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">続きを読む</a>
                @endauth
            </div>
        </div>
        @endforeach

        <hr>
    </div>
</div>
@endsection