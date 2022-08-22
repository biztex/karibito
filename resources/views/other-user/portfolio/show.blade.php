<x-other-user.layout>
	<article>
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
        <x-parts.flash-msg/>

        <div id="contents" class="otherPage">
            <div class="inner02 clearfix">
                <div id="main">
                    <div class="portfolioDtWrap">
                        <h2 class="portfolioDtHd">{{ $portfolio->title }}</h2>
                        <p class="portfolioDtDate">{{ $portfolio->year }}年 {{ $portfolio->month }}月</p>
                        <div class="portfolioDtCont">
                            <p class="portfolioDtImg"><img src="{{ asset('/storage/'.$portfolio->path)}}" alt=""></p>
                            <p class="portfolioDtDetail">{{ $portfolio->detail }}</p>
                        </div>
                        <ul class="detailSns">
                            <li><a href="http://www.facebook.com/share.php?u={{ $url }}"><img src="/img/mypage/ico_facebook.svg" alt=""></a></li>
                            <li><a href="https://social-plugins.line.me/lineit/share?url={{ $url }}"><img src="/img/mypage/ico_line.svg" alt=""></a></li>
                            <li><a href="https://twitter.com/share?url={{ $url }}&text={{  $portfolio->title }} %20%7C%20 {{ $portfolio->user->name }} %20%7C%20ポートフォリオ %20%7C%20 カリビト&hashtags=karibito" target="_blank"><img src="/img/mypage/ico_twitter.svg" alt=""></a></li>
                            <li><a href="mailto:?subject=カリビトのポートフォリオをシェア&body={{ $portfolio->title }} %20%7C%20 {{ $portfolio->user->name }} %20%7C%20ポートフォリオ %20%7C%20 カリビト {{ $url }}" target="_blank"><img src="/img/mypage/ico_mail.svg" alt=""></a></li>
                        </ul>
                        @if (count($portfolio_list) > 1)
                            <div class="detialPager">
                                <div class="secretPager">
                                    @if($portfolio->id == $portfolio_list[0]->id)
                                        <div class="secretPagerPrev"><a href="{{ route('user.portfolio.show', [$user, collect($portfolio_list)->last()->id]) }}">前へ</a></div>
                                    @else
                                        <div class="secretPagerPrev"><a href="{{ route('user.portfolio.show', [$user, $prev_page]) }}">前へ</a></div>
                                    @endif
                                    <select onchange="document.location.href=this.options[this.selectedIndex].value;">
                                        @foreach ($portfolio_list as $i => $pf)
                                            <option value="{{ route('user.portfolio.show', [$user, $pf]) }}" @if($portfolio->id == $pf->id) selected @endif>{{ $i + 1}}/{{ count($portfolio_list) }}</option>
                                        @endforeach
                                    </select>
                                    @if ($portfolio->id == collect($portfolio_list)->last()->id)
                                        <div class="secretPagerNext"><a href="{{ route('user.portfolio.show', [$user, $portfolio_list[0]->id]) }}">次へ</a></div>
                                    @else
                                        <div class="secretPagerNext"><a href="{{ route('user.portfolio.show', [$user, $next_page]) }}">次へ</a></div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div><!-- /#main -->
                @include('other-user.parts.side')
            </div><!--inner-->
        </div><!-- /#contents -->
	</article>
</x-other-user.layout>
