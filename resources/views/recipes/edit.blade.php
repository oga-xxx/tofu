<div>
    <h2>編集</h2>
</div>
<div>
    <a href="{{ route('recipes.index') }}"> 戻る</a>
</div>

<form action="{{ route('recipes.update',$recipe->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>料理名:</strong>
        <input type="text" name="name" value="{{ $recipe->name }}" placeholder="Name">
    </div>
    <div>
        <strong>料理写真:</strong>
        <input type="file" name="image" value="{{ $recipe->image }}" placeholder="Immage">
    </div>
    <div>
        <strong>調理方法:</strong>
        <textarea style="height:150px" name="cooking" placeholder="cooking">{{ $recipe->cooking }}</textarea>
    </div>
    <div>
        <strong>豆腐感:</strong>
        <input type="number" name="score"  value="{{ $recipe->score }}">
    </div>
    <div>
    <strong>Category:</strong>
        <select name="category_id">
        @foreach ($categories as $category)
            @if ($category->id == $recipe->category_id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
        </select>
    </div>
    <div>
        <button type="submit">編集</button>
    </div>

</form>