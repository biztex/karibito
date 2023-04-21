<x-layout>
    <x-parts.post-button/>
    <div id="portfolio">

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
                            <div style="margin-bottom: 10px;">登録したポートフォリオは詳細画面からシェアできます。詳細画面は画像をクリックすると表示されます。</div>
                            <ul class="mypagePortfolioUl02">
                                <li class="editLi">
                                    <a href="{{ route('portfolio.create') }}" class="editLiLink">
                                        <img src="img/mypage/edit_portfolio.jpg" alt="">
                                    </a>
                                </li>
                                @foreach ($portfolio_list as $portfolio)
                                    <li class="editLi">
                                        <a href="{{ route('portfolio.show', $portfolio) }}" class="editLiLink">
                                            <img src="{{ asset('/storage/'.$portfolio->path)}}" alt="">
                                        </a>
                                        <div class="editP">
                                            <a href="{{ route('portfolio.edit', $portfolio) }}" class="editPLink">編集する</a>
                                            <form id="delete-portfolio" action="{{ route('portfolio.destroy', $portfolio) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete js-alertModal">削除</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div><!-- /#main -->
                <x-side-menu/>

                <x-parts.alert-modal phrase="このポートフォリオを削除しますか？" formId="delete-portfolio" />
            </div>
        </div><!-- /#contents -->
    </div>
    <x-hide-modal/>
</x-layout>