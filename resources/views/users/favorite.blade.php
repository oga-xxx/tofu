@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>お気に入り</h1>

        <hr>

        <div class="row">
            @foreach ($favorites as $fav)
            <div class="col-md-7 mt-2">
                <div class="d-inline-flex">
                    <a href="{{route('recipes.show', $fav->favoriteable_id)}}" class="w-25">
                    @if (App\Models\recipe::find($fav->favoriteable_id)->image !== "")
                    <img src="{{ asset(App\Models\recipe::find($fav->favoriteable_id)->image) }}" class="img-fluid w-100">
                    @else
                    <img src="{{ asset('mg/no_image.png') }}" class="img-fluid w-100">
                    @endif
                    </a>
                    <div class="container mt-3">
                        <h5 class="w-100 item-text">{{App\Models\recipe::find($fav->favoriteable_id)->name}}</h5>
                        <h6 class="w-100 item-text">置き換え:{{App\Models\recipe::find($fav->favoriteable_id)->category->name}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <a href="{{ route('recipes.favorite', $fav->favoriteable_id) }}" class="item-delete">
                    削除
                </a>
            </div>
            @endforeach
        </div>

        <hr>
    </?div>
</div>
@endsection
