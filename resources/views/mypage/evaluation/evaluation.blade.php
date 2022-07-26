<x-layout>
<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<span>評価一覧</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="#"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap evaluationWrap">
						<h2 class="subPagesHd">評価一覧</h2>
						<div class="evaluationStar">
							<span>総評</span>
							<div class="evaluate three"></div>
						</div>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active"><img src="/img/common/ico_like_top.png">良かった({{ $counts['good'] }})</a></li>
								<li><a href="#tab_box02" id="box02"><img src="/img/common/ico_like_middle.png">普通({{ $counts['usually'] }})</a></li>
								<li><a href="#tab_box03" id="box03"><img src="/img/common/ico_like_no.png">残念だった({{ $counts['pity'] }})</a></li>
							</ul>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="evaluationUl01">
                                    @if($evaluations['good']->isEmpty())
                                        <p>「良かった」の評価はありません。</p>
                                    @else
                                        @foreach($evaluations['good'] as $value)
                                        <li>
                                            <div class="img">
                                                <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                            </div>
                                            <div class="info">
                                                <p class="name">{{ $value->user->name }}<span>出品者</span></p>
                                                <div class="cont">
                                                    <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
                                                    <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                    {{ $evaluations['good']->fragment('')->links() }}
								</ul>
							</div>
							<div class="tabBox " id="tab_box02">
                                <ul class="evaluationUl01">
                                    @if($evaluations['usually']->isEmpty())
                                        <p>「普通」の評価はありません。</p>
                                    @else
                                        @foreach($evaluations['usually'] as $value)
                                        <li>
                                            <div class="img">
                                                <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                            </div>
                                            <div class="info">
                                                <p class="name">{{ $value->user->name }}<span>出品者</span></p>
                                                <div class="cont">
                                                    <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
                                                    <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                    {{ $evaluations['usually']->fragment('usually')->links() }}
								</ul>
							</div>
							<div class="tabBox " id="tab_box03">
                                <ul class="evaluationUl01">
                                    @if($evaluations['pity']->isEmpty())
                                        <p>「残念だった」の評価はありません。</p>
                                    @else
                                        @foreach($evaluations['pity'] as $value)
                                        <li>
                                            <div class="img">
                                                <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                            </div>
                                            <div class="info">
                                                <p class="name">{{ $value->user->name }}<span>出品者</span></p>
                                                <div class="cont">
                                                    <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
                                                    <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                    {{ $evaluations['pity']->fragment('pity')->links() }}
                                 </ul>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>