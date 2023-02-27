<x-other-user.layout>
	<article>
		<div class="otherNav">
			<div class="inner">
				<ul>
					<li><a href="#" class="is_active">ホーム</a></li>
					<li><a href="{{ route('user.evaluation', $user->id) }}">評価</a></li>
					<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
					<li><a href="{{ route('user.portfolio', $user->id) }}">ポートフォリオ</a></li>
					<li><a href="{{ route('user.publication', $user->id) }}">出品サービス</a></li>
					<li><a href="{{ route('user.blog', $user->id) }}">ブログ</a></li>
				</ul>
			</div>
		</div>

		<x-parts.post-button/>
        <x-parts.flash-msg/>

        <div id="contents" class="oneColumnPage03 otherPage">
			<div class="inner">
				<div id="main">
					<div class="otherMypageWrap">
						<div class="mypageSec01">
							<div class="mypageCover">
								<div class="cover_background">
									@if(!empty($user->userProfile->cover))
										<img src="{{asset('/storage/'.$user->userProfile->cover) }}">
									@else
										<img src="/img/mypage/img_rainbow.png" style="object-fit: cover;">
									@endif
								</div>
							</div>
							<div class="inner">
								<dl class="mypageDl01">
									@if(null !== $user->userProfile->icon)
                                        <dt><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt="" style="height:132px;"></dt>
                                    @else
										<dt><img src="/img/mypage/no_image.jpg" alt=""></dt>
                                    @endif
									<dd>
										<div class="mypageP01">
											<p class="word-break ">{{$user->name}}</p>
											<div class="blogDtOtherBtn">
                                            @if (\Auth::id() !== $user->id)
												@if(empty($dmrooms))
													<a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
												@else
													<a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
												@endif
                                                @if(\Auth::user())
                                                    @if(App\Models\UserFollow::IsFollowing($user->id))
                                                        <form id="follow-sub-form" action="{{ route('follow.sub', ['id' => $user->id]) }}" method="get">
                                                            @csrf
                                                            <a type="button" class="followB js-alertModal" style="cursor: pointer">フォロー済み</a>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('follow.add', ['id' => $user->id]) }}" class="followA">フォローする</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('follow.add', ['id' => $user->id]) }}" class="followA">フォローする</a>
                                                @endif
                                            @endif
											</div>
										</div>
										<p class="mypageP02">最終ログイン：{{ $user->latest_login_datetime }}</p>
										<p class="mypageP03">({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{$user->userProfile->age}}/ {{$user->userProfile->prefecture->name}}) </p>
										<div class="countBox">
											<p class="countItem">販売実績数：{{ $total_sales_count }}</p>
											<p class="countItem">キャンセル完了数：{{ $cancel_count }}</p>
										</div>
										<p class="mypageP04 check">
                                            @if ($user->userProfile->is_identify)
                                                <a>本人確認済み</a>
												<a>NDA可</a>
                                            @endif
                                        </p>
										<p class="mypageP05"></p>
										<div class="mypageP06">
											<x-parts.evaluation-star :star='$user->avg_star'/>
										</div>
									</dd>
								</dl>
								<div class="mypageIntro">
									<p class="mypageHd01">自己紹介</p>
									<div class="mypageIntroTxt otherIntroTxt">
										<p>{!! nl2br(e($user->userProfile->introduction)) !!}</p>
									</div>
								</div>
                                @if (!$user->specialty->isEmpty())
                                <div class="mypageProud">
									<p class="mypageHd01">得意分野</p>
									<ul class="mypageProudUl">
                                        @foreach ($user->specialty as $specialty)
                                            <li>{{ $specialty->content }}</li>
                                        @endforeach
									</ul>
								</div>
                                @endif
							</div>
						</div>
						<div class="otherMypageSec01">
							<div class="inner">
								<div class="mypageHd02">
									<p>現在の出品サービス一覧</p>
									@if($products->isNotEmpty())
										<a href="{{ route('user.publication', $user->id) }}" class="more">出品サービスをもっと見る</a>
									@endif
								</div>

								{{-- <div class="recommendList style2 ">
									<div class="list sliderSP02"> --}}

										<div class="indexTab tabWrap wMax">
                                            @if (($products->isEmpty()) && ($user->jobRequest->isEmpty()))
                                                <p>投稿がありません。</p>
                                            @else
                                                <ul class="tabLink">
                                                    <li><a href="#tab_box01" class="is_active">提供</a></li>
                                                    <li><a href="#tab_box02">リクエスト</a></li>
                                                </ul>
                                                <div class="tabBox is_active" id="tab_box01">
                                                    @if($products->isEmpty())
                                                        <p>投稿がありません。</p>
                                                    @else
														<div class="recommendList style2 ">
															<div class="list sliderSP02">
															@foreach($products as $product)

																<x-parts.product-item :product="$product"/>

															@endforeach
															</div>
														</div>
													@endif
												</div>

                                                <div class="tabBox" id="tab_box02">
                                                    @if($job_request->isEmpty())
                                                        <p>投稿がありません。</p>
                                                    @else
														<div class="recommendList style2 ">
															<div class="list sliderSP02">
																@foreach($job_request as $value)

																	<x-parts.job-request-item :value="$value"/>

																@endforeach
															</div>
														</div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
									</div>
									{{-- </div>
								</div> --}}
							</div>

						<div class="mypageSec04">
							<div class="inner">
								<div class="mypageHd02">
									<p>スキル・経歴・職務</p>
									@if ($user->userSkills->isNotEmpty())
										@if (\Auth::id() === $user->id)
											<a href="{{ route('resume.show') }}" class="more">スキル・経歴・職務を編集する</a>
										@else
											<a href="{{ route('user.skills', $user->id) }}" class="more">スキル・経歴をもっと見る</a>
										@endif
									@endif
								</div>
								<div class="mypageItem">
									<p class="mypageHd03">スキル</p>
                                    @if ($user->userSkills->isEmpty())
                                        <p>スキルの登録がありません。</p>
                                    @else
									<div class="mypageBox">
										<dl class="mypageDl02">
											<dt>スキル詳細</dt>
											<dd>
												<ul class="mypageUl03">
                                                    @foreach ($user->userSkills as $skill)
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
                                            @foreach ($user->userCareers as $userCareer)
                                                <li>
                                                    <dl class="mypageDl02">
                                                        <dt>経歴名</dt>
                                                        <dd><span>{{ $userCareer->name }}</span></dd>
                                                    </dl>
                                                    <dl class="mypageDl02">
                                                        <dt>在籍期間</dt>
                                                        <dd>{{ $userCareer->first_year }}年 {{ $userCareer->first_month }}月 〜 {{ $userCareer->last_year }}年 {{ $userCareer->last_month }}月</dd>
                                                    </dl>
                                                </li>
                                            @endforeach
										</ul>
									</div>
                                    @endif
								</div>
							</div>
						</div>
						<div class="mypageSec05">
							<div class="inner">
								<div class="mypageHd02">
									<p>ポートフォリオ</p>
									@if ($portfolio_list->isNotEmpty())
										@if (\Auth::id() === $user->id)
											<a href="{{ route('portfolio.index') }}" class="more">ポートフォリオを編集する</a>
										@else
											<a href="{{ route('user.portfolio', $user) }}" class="more">ポートフォリオをもっと見る</a>
										@endif
									@endif
								</div>

                                @if ($portfolio_list->isEmpty())
                                    <p>ポートフォリオの登録がありません。</p>
                                @else
                                    <ul class="mypagePortfolioUl">
                                        @foreach ($portfolio_list as $portfolio)
										<li class="editLi">
											<a href="{{ route('user.portfolio.show', [$user, $portfolio]) }}" class="editLiLink">
												<img src="{{ asset('/storage/'.$portfolio->path)}}" alt="">
											</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
							</div>
						</div>

						<div class="otherMypageSec02">
							<div class="inner">
								<div class="mypageHd02">
									<p>依頼者からの評価</p>
									@if($evaluations['good']->isNotEmpty() || $evaluations['usually']->isNotEmpty() || $evaluations['pity']->isNotEmpty())
										<a href="{{ route('user.evaluation', $user->id) }}" class="more">評価をもっと見る</a>
									@endif
								</div>
								<div class="evaluationStar">
									<span>総評</span>
									<x-parts.evaluation-star :star='$user->avg_star'/>
								</div>
								<div class="subPagesTab tabWrap">
									<ul class="tabLink">
										{{-- 提供の#tab_box01と被っていてうまくいかなかったため、変更した --}}
										<li><a href="#tab_box03" class="is_active"><img src="/img/common/ico_like_top.png">良かった({{ $counts['good'] }})</a></li>
										<li><a href="#tab_box04" id="box02"><img src="/img/common/ico_like_middle.png">普通({{ $counts['usually'] }})</a></li>
										<li><a href="#tab_box05" id="box03"><img src="/img/common/ico_like_no.png">残念だった({{ $counts['pity'] }})</a></li>
									</ul>
									<div class="tabBox is_active" id="tab_box03">
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

									<div class="tabBox" id="tab_box04">
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

									<div class="tabBox" id="tab_box05">
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
							</div><!-- inner -->
						</div><!-- otherMypageSec02 -->
					</div><!-- otherMypageWrap -->
				</div><!-- /#main -->
			</div><!--inner-->
		</div><!-- /#contents -->
        <x-parts.alert-modal phrase="フォローを解除してもよろしいですか？" value="フォロー解除" formId="follow-sub-form" />
	</article>
</x-other-user.layout>
