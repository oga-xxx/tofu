@extends('layouts.app')

@section('content')
<article>
  <div>
    <h1>新規投稿</h1>

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

    <form action="{{ route('posts.store') }}" method="post">
      @csrf
      <div class="form-group mb-3">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
      </div>
      <div class="form-group mb-3">
        <label for="content">本文</label>
        <textarea class="form-control" name="content">{{ old('content') }}</textarea>
      </div>
      <button type="submit" class="btn btn-outline-primary">投稿</button>
    </form>
  </div>
</article>
@endsection