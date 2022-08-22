<x-other-user.layout>
	<x-parts.post-button/>

	<article>
		<div class="otherNav">
			<div class="inner">
				<ul>
					<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
					<li><a href="{{ route('user.evaluation', $user->id) }}">評価</a></li>
					<li><a href="#" class="is_active">スキル・経歴</a></li>
					{{-- <li><a href="{{ route('user.portfolio', $user->id) }}">ポートフォリオ</a></li> --}}
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
					<div class="">

						<div class="mypageSec04">
							<p class="mypageHd02"><span>スキル・経歴・職務</span></p>
							<div class="mypageItem">
								<p class="mypageHd03">スキル</p>
								@if ($skills->isEmpty())
                                        <p>スキルの登録がありません。</p>
                                @else
									<div class="mypageBox">
										<dl class="mypageDl02">
											<dt>スキル詳細</dt>
											<dd>
												<ul class="mypageUl03" style="word-wrap: break-word;">
													@foreach($skills as $skill)
														<li><span>{{ $skill->name }}</span>経験：{{ $skill->year }}年</li>
													@endforeach
												</ul>
											</dd>
										</dl>
									</div>
								@endif
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">経歴</p>
								@if ($user->userCareers->isEmpty())
                                    <p>経歴の登録がありません。</p>
                                @else
									<div class="mypageBox">
										<ul class="mypageUl03">
											@foreach($careers as $career)
												<li>
													<dl class="mypageDl02" style="word-wrap: break-word;">
														<dt>経歴名</dt>
														<dd><span>{{ $career->name }}</span></dd>
													</dl>
													<dl class="mypageDl02">
														<dt>在籍期間</dt>
														<dd>{{ $career->first_year }}年 {{ $career->first_month }}月 〜 @if($career->last_year == null && $career->last_month == null)現在 @else{{ $career->last_year }}年 {{ $career->last_month }}月 @endif</dd>
													</dl>
												</li>
											@endforeach
										</ul>
									</div>
								@endif
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">職務</p>
								@if (is_null($jobs))
                                        <p>職務の登録がありません。</p>
                                @else
									<div class="mypageBox">
										<div class="mypageDuties" style="word-wrap: break-word;">
											<p>{!!nl2br($jobs->content)!!}</p>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				@include('other-user.parts.side')
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-other-user.layout>
