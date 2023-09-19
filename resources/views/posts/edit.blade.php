@extends('layouts.app')

@section('content')
<article>
  <div>
    <h1>投稿編集</h1>

    @if($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div>
      <a href="{{ route('posts.index') }}">&lt; 戻る</a>
    </div>

    <form action="{{ route('posts.update', $post) }}" method="post">
      @csrf
      @method('patch')
      <div class="form-group mb-3">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}">
      </div>
      <div class="form-group mb-3">
        <label for="content">本文</label>
        <textarea class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
      </div>
      <button type="submit" class="btn btn-outline-primary">更新</button>
    </form>
  </div>
</article>
@endsection