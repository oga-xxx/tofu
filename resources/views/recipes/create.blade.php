<div>
    <h2>新しいレシピの追加</h2>
</div>
<div>
    <a href="{{ route('recipes.index') }}">戻る</a>
</div>

<form action="{{ route('recipes.store') }}" method="POST">
    @csrf

    <div>
        <strong>名前:</strong>
        <input type="text" name="name" placeholder="Name">
    </div>
    <div>
        <strong>画像:</strong>
        <input type="file" name="image" placeholder="Image">
    </div>
    <div>
        <strong>調理方法:</strong>
        <textarea style="height:150px" name="cooking" placeholder="Cooking"></textarea>
    </div>
    <div>
        <strong>豆腐感:</strong>
        <input type="number" name="score" placeholder="Score">
    </div>
    <div>
        <strong>置き換え:</strong>
        <select name="category_id">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">完了</button>
    </div>
</form>