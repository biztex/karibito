<div class="recommendCates">
    <h2 class="hdM">おすすめのカテゴリー</h2>
    <ul>
        @foreach (App\Models\MProductCategory::all() as $category)
            @if (empty($category->top_image_path))
                <li><a href="{{route('product.category.index', $category->id) }}" class="cate{{ $category->id }}">{{ $category->name }}</a></li>
            @else
                <li><a href="{{route('product.category.index', $category->id) }}" style="background-image: url({{ Illuminate\Support\Facades\Storage::url($category->top_image_path) }}); height: 72px;">{{ $category->name }}</a></li>
            @endif
        @endforeach
    </ul>
</div>