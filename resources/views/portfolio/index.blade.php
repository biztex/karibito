<x-layout>
<x-parts.post-button/>
    <article>
        <body id="portfolio">

            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<span>ポートフォリオ</span>
                </div>
            </div><!-- /.breadcrumb -->

            <x-parts.ban-msg/>
            <x-parts.flash-msg/>

            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="mypageWrap">
                            <div class="mypageSec05">
                                <p class="mypageHd02"><span>ポートフォリオ</span></p>
                                <ul class="mypagePortfolioUl02">
                                    <li class="editLi">
                                        <a href="{{ route('portfolio.create') }}">
                                            <p class="imgP"><img src="img/mypage/edit_portfolio.jpg" alt=""></p>
                                        </a>
                                    </li>
                                    @foreach ($portfolio_list as $portfolio)
                                    <form action="{{ route('portfolio.destroy', $portfolio) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <li>
                                            </a><p class="imgP"><a href="{{ route('portfolio.show', $portfolio) }}"><img src="{{ asset('/storage/'.$portfolio->path)}}" alt=""></a></p>
                                            <p class="editP"><a href="{{ route('portfolio.edit', $portfolio) }}">編集する</a>
                                                <button onclick='return confirm("このポートフォリオを削除しますか？");' class="delete">削除</button>
                                            </p>
                                        </li>
                                    </form>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div><!-- /#main -->
                    <x-side-menu/>
                </div>
            </div><!-- /#contents -->
        </body>
        <x-hide-modal/>
    </article>
</x-layout>
