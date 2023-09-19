@extends('layouts.app')

@section('content')
<div class="card mb-3" style="max-width: 1000px;">
  <div class="row g-0">
    <div class="col-md-4">
      @if ($recipe->image !== "")
      <img src="{{ asset($recipe->image) }}" alt=“料理の画像” class="img-fluid rounded-start">
      @else
      <img src="{{ asset('img/no_image.png')}}" alt=“料理の画像” class="img-fluid rounded-start">
      @endif
      <p><small>
          @if($recipe->isFavoritedBy(Auth::user()))
          <a href="{{ route('recipes.favorite', $recipe) }}" class="btn text-dark w-100">
            <i class="fa fa-heart"></i>
            お気に入り解除
          </a>
          @else
          <a href="{{ route('recipes.favorite', $recipe) }}" class="btn text-dark w-100">
            <i class="fa fa-heart"></i>
            お気に入り
          </a>
          @endif
        </small></p>
    </div>

    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$recipe->name}}</h5>
        <p class="card-text">調理方法</p>
        <p class="card-text">{{$recipe->cooking}}</p>
      </div>
    </div>
  </div>
</div>

@endsection