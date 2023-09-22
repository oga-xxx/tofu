@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center">
  <h1>投稿一覧</h1>

  @if (session('flash_message'))
  <p>{{ session('flash_message') }}</p>
  @endif

  @auth
  <div>
    <a href="{{ route('posts.create') }}">新規投稿</a>
  </div>
  @endauth

  @foreach($posts as $post)
  <div class="card" style="width: 20rem;">
    <p><small>{{$post->user->name}}</small></p>
    <p><small>{{$post->created_at}}</small></p>
      @if ($post->image !== "")
      @php
      var_dump($post->image);
      var_dump("あああああああああああああ");
      $image_path = "app/public/"  . $post->image;
      @endphp
      <img src="{{ Storage::url( "app/public/"  . $post->image) }}" alt=“料理の画像” class="card-img-top">
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
</div>
@endsection