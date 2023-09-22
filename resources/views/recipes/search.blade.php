@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-sm-4">
        <div class="text-center my-4">
            <h3 class="brown border p-2">レシピ検索</h3>
        </div>
        <form method="GET" action="{{ route('search') }}" class="p-5" enctype="multipart/form-data">
            @csrf
            <div class="select-tag">
                <div class="dn-title">
                    <input id="name" type="text" placeholder="料理名" name="name">
                    <div class="st-area">
                        <p>タグを選択してください</p>
                        <div class="st-flex">
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach($categories as $category)
                                <option value="" hidden>置き換え▼</option>
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="st-flex">
                            <select name="score" class="form-control score-color">
                                <option value="" hidden>豆腐感▼</option>
                                <option value="5" class="score-color">★★★★★ 豆腐を全く、感じない</option>
                                <option value="4" class="score-color">★★★★ 豆腐を感じない</option>
                                <option value="3" class="score-color">★★★ 豆腐の味が少しする</option>
                                <option value="2" class="score-color">★★ 豆腐の味がする</option>
                                <option value="1" class="score-color">★ 豆腐の味がかなりする</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ulb-frame" class="form-group mb-0 mt-3">
                <button type="submit" id="uploadBtn" class="btn btn-block btn-secondary">
                    検索する
                </button>
            </div>
            <div class="col-sm-8">
                <div class="text-center my-4">
                    <h3 class="brown p-2">レシピ一覧</h3>
                </div>

                <div>
                    @if(!empty($data))
                    @foreach($data as $recipe)
                    <div class="card"  style="width: 18rem;">
                        @if ($recipe->image !== "")
                        <img src="{{ asset($recipe->image) }}" alt="カードの画像" class="card-img-top">
                        @else
                        <img src="{{ asset('img/no_image.png')}}" alt="カードの画像" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->name }}</h5>
                            <p class="card-text">
                                豆腐⇨{{ $recipe->category->name }}
                                <br>
                                豆腐感:{{ str_repeat('★', $recipe->score) }}
                            </p>
                            <a href="{{ route('recipes.show',$recipe->id) }}" class="btn btn-primary">作り方</a>
                        </div>
                    </div>
                    @endforeach
                    {{ $data->appends(request()->input())->render('pagination::bootstrap-4') }}
                    @endif
                </div>

        </form>
    </div>
</div>
@endsection