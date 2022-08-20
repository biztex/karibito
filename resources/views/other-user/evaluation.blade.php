<x-other-user.layout>
	<article>
		<div class="otherNav">
			<div class="inner">
				<ul>
					<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
					<li><a href="#" class="is_active">評価</a></li>
					<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
					<li><a href="{{ route('user.portfolio', $user->id) }}">ポートフォリオ</a></li>
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
					<div class="subPagesWrap evaluationWrap">
						<h2 class="subPagesHd">評価一覧</h2>
						<div class="evaluationStar">
							<span>総評</span>
							<x-parts.evaluation-star :star='$user->avg_star'/>
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

							                <x-parts.evaluation :value='$value'/>

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

							            <x-parts.evaluation :value='$value'/>
                                    
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

							            <x-parts.evaluation :value='$value'/>
                                            
                                    @endforeach
                                @endif
                                    {{ $evaluations['pity']->fragment('pity')->links() }}
								</ul>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				@include('other-user.parts.side')
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-other-user.layout>
