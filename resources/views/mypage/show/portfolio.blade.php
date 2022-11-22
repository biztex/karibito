<div class="mypageSec05">
    <p class="mypageHd02"><span>ポートフォリオ</span><br>
    <a href="{{ route('portfolio.index') }}" class="more">ポートフォリオを編集する</a></p>
    @if (Auth::user()->portfolios->isEmpty())
            <p>ポートフォリオの登録はありません。</p>
    @else
        <ul class="mypagePortfolioUl">
            @foreach (Auth::user()->portfolios as $portfolio)
                <li class="editLi">
                    <a href="{{ route('user.portfolio.show', [Auth::id(), $portfolio]) }}" class="editLiLink">
                        <img src="{{ asset('/storage/'.$portfolio->path)}}" alt="">
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
