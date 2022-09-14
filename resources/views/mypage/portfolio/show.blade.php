<x-layout>
<x-parts.post-button/>
    <article>
        <body id="portfolio">
            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('portfolio.index') }}">ポートフォリオ</a>　>　<span>{{ $portfolio->title }}</span>
                </div>
            </div><!-- /.breadcrumb -->

            <x-parts.flash-msg/>

            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="portfolioDtWrap">
                            <h2 class="portfolioDtHd break-word">{{ $portfolio->title }}</h2>
                            <p class="portfolioDtDate">{{ $portfolio->year }}年 {{ $portfolio->month }}月</p>
                            <div class="portfolioDtBreadcrumbs">
                                <span>{{$portfolio->mProductChildCategory->mProductCategory->name}}</span>　>　<span>{{$portfolio->mProductChildCategory->name}}</span>
                            </div>
                            <div class="portfolioDtCont">
                                <p class="portfolioDtImg"><img src="{{ asset('/storage/'.$portfolio->path)}}" alt=""></p>
                                <p class="portfolioDtDetail">{{ $portfolio->detail }}</p>
                            </div>
                            @if ($portfolio->portfolioLink->isNotEmpty()) {{--YouTubeの動画--}}
                                <div class="content">
                                    <div class="optional">
                                        <h2 class="hdM">参考動画</h2>
                                        @foreach($portfolio->portfolioLink as $portfolio_link)
                                            <iframe class="" height="400" width="100%" src="{{ $portfolio_link->iframe_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
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
                                            <div class="secretPagerPrev"><a href="{{ route('portfolio.show', collect($portfolio_list)->last()->id) }}">前へ</a></div>
                                        @else
                                            <div class="secretPagerPrev"><a href="{{ route('portfolio.show', $prev_page) }}">前へ</a></div>
                                        @endif
                                        <select onchange="document.location.href=this.options[this.selectedIndex].value;">
                                            @foreach ($portfolio_list as $i => $pf)
                                                <option value="{{ route('portfolio.show', $pf) }}" @if($portfolio->id == $pf->id) selected @endif>{{ $i + 1}}/{{ count($portfolio_list) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($portfolio->id == collect($portfolio_list)->last()->id)
                                            <div class="secretPagerNext"><a href="{{ route('portfolio.show', $portfolio_list[0]->id) }}">次へ</a></div>
                                        @else
                                            <div class="secretPagerNext"><a href="{{ route('portfolio.show', $next_page) }}">次へ</a></div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div><!-- /#main -->
                    <x-side-menu/>
                </div>
            </div><!-- /#contents -->
        </body>
        <x-hide-modal/>
    </article>
</x-layout>