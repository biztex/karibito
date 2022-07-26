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
								<li><a href="#tab_box01" class="is_active"><img src="/img/common/ico_like_top.png">良かった({{ $count_good }})</a></li>
								<li><a href="#tab_box02"><img src="/img/common/ico_like_middle.png">普通({{ $count_normal }})</a></li>
								<li><a href="#tab_box03"><img src="/img/common/ico_like_no.png">残念だった({{ $count_bad }})</a></li>
							</ul>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="evaluationUl01">
                                    @foreach($good_evaluations as $good_evaluation)
									<li>
										<div class="img">
											<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
										</div>
										<div class="info">
											<p class="name">{{ $good_evaluation->user->name }}<span>出品者</span></p>
											<div class="cont">
												<p class="date">{{ $good_evaluation->created_at->format('Y年m月d日') }}</p>
												<p class="txt" style="word-wrap: break-word;">{!!nl2br($good_evaluation->text)!!}</p>
											</div>
										</div>
									</li>
									@endforeach
                                    {{ $good_evaluations->links() }}
								</ul>
							</div>
							<div class="tabBox " id="tab_box02">
                                <ul class="evaluationUl01">
                                    @foreach($normal_evaluations as $normal_evaluation)
                                    <li>
                                        <div class="img">
                                            <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                        </div>
                                        <div class="info">
                                            <p class="name">{{ $normal_evaluation->user->name }}<span>出品者</span></p>
                                            <div class="cont">
                                                <p class="date">{{ $normal_evaluation->created_at->format('Y年m月d日') }}</p>
                                                <p class="txt" style="word-wrap: break-word;">{!!nl2br($normal_evaluation->text)!!}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    {{ $normal_evaluations->links() }}
								</ul>
							</div>
							<div class="tabBox " id="tab_box03">
                                <ul class="evaluationUl01">
                                    @foreach($bad_evaluations as $bad_evaluation)
                                    <li>
                                        <div class="img">
                                            <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                        </div>
                                        <div class="info">
                                            <p class="name">{{ $bad_evaluation->user->name }}<span>出品者</span></p>
                                            <div class="cont">
                                                <p class="date">{{ $bad_evaluation->created_at->format('Y年m月d日') }}</p>
                                                <p class="txt" style="word-wrap: break-word;">{!!nl2br($bad_evaluation->text)!!}</p>
                                            </div>{!!nl2br($bad_evaluation->text)!!}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                    {{ $bad_evaluations->links() }}
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