<x-other-user.layout>
	<div class="otherNav">
		<div class="inner">
			<ul>
				<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
				<li><a href="{{ route('user.evaluation', $user->id) }}">評価</a></li>
				<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
				<li><a href="" class="is_active">ポートフォリオ</a></li>
				<li><a href="{{ route('user.publication', $user->id) }}">出品サービス</a></li>
				<li><a href="#">ブログ</a></li>
			</ul>
		</div>
	</div>
	<x-parts.post-button/>
	<article>
        <x-parts.flash-msg/>
			<div id="contents" class="otherPage">
				<div class="inner02 clearfix">
					<div id="main">
                        <div class="mypageWrap">
                            <div class="mypageSec05">
                                <p class="mypageHd02"><span>ポートフォリオ</span></p>
                                <ul class="mypagePortfolioUl02">
                                    @if ($portfolio_list->isEmpty())
                                        <p>ポートフォリオの登録はありません。</p>
                                    @else
                                        @foreach ($portfolio_list as $portfolio)
                                            <li>
                                                <p class="imgP"><a href="{{ route('user.portfolio.show', [$user, $portfolio]) }}"><img src="{{ asset('/storage/'.$portfolio->path)}}" alt=""></a></p>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div><!-- /#main -->
					@include('other-user.parts.side')
				</div><!--inner-->
			</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-other-user.layout>
