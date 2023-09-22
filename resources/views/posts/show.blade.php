@extends('layouts.app')

@section('content')
<article>
  <div class="row d-flex justify-content-center">
    <h1>投稿詳細</h1>

    @if (session('flash_message'))
    <p>{{ session('flash_message') }}</p>
    @endif

    <div class="card" style="width: 50rem;">
      <p><small>{{$post->user->name}}</small></p>
      <p><small>{{$post->created_at}}</small></p>
      @if ($post->image !== "")
      <img src="{{ Storage::url($post->img) }}" alt=“料理の画像” class="card-img-top">
      @else
      <img src="{{ asset('img/no_image.png')}}" alt=“料理の画像” class="card-img-top">
      @endif
      <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->content }}</p>
        @if ($post->id == $post->user_id)
        <div class="d-flex">
          <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary d-block me-1">編集</a>

          <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-danger">削除</button>
          </form>
        </div>
        @endif
      </div>
    </div>

    <div>
      <hr>
      <h3>コメント</h3>
    </div>

    <div>
      <div>
        @foreach($comments as $comment)
        <div>
          <p>{{$comment->content}}</p>
          <label>{{$comment->created_at}} {{$comment->user->name}}</label>
        </div>
        @endforeach
      </div><br />

      @auth
      <div>
        <div>
          <form method="POST" action="{{ route('comment.store') }}">
            @csrf
            <h4>コメント内容</h4>
            @error('content')
            <strong>コメント内容を入力してください</strong>
            @enderror
            <textarea name="content"></textarea>
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button type="submit">コメントする</button>
          </form>
        </div>
      </div>
      @endauth
    </div>
  </div>
  </div>
  </div>
</article>
@endsection