@extends('layouts.app')

@section('content')
<a href="{{ route('recipes.create') }}">レシピ製作</a>

<table>
  <tr>
    <th>料理名</th>
    <th>画像</th>
    <th>豆腐感</th>
    <th>置き換え</th>
  </tr>
  @foreach ($recipes as $recipe)
  <tr>
    <td>{{ $recipe->name }}</td>
    <td>@if ($recipe->image !== "")
        <img src="{{ asset($recipe->image) }}" class="img-thumbnail">
        @else
        <img src="{{ asset('img/no_image.png')}}" class="img-thumbnail">
        @endif</td>
    <td>{{ str_repeat('★', $recipe->score) }}</td>
    <td>{{ $recipe->category->name }}</td>
    <td>
    <form action="{{ route('recipes.destroy',$recipe->id) }}" method="POST">
      <a href="{{ route('recipes.show',$recipe->id) }}">作り方</a>
      <a href="{{ route('recipes.edit',$recipe->id) }}">編集</a> 
      @csrf
      @method('DELETE')
      <button type="submit">削除</button>
    </form>
    </td>
  </tr>
  @endforeach
</table>
@endsection