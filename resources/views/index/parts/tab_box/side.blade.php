<aside id="side" class="pc">
    <h2>サービス一覧</h2>
    <ul class="links">
    @foreach(App\Models\MProductCategory::all() as $category)
        <li><a href="{{route('product.category.index', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
    </ul>
    <h2>ガイド</h2>
    <ul class="links">
        <li><a href="{{ route('support') }}">ご利用ガイド</a></li>
        <li><a href="#">よくある質問</a></li>
        <li><a href="{{ route('privacy-policy') }}">プライバシーポリシー</a></li>
        <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
    </ul>
</aside><!-- /#side -->