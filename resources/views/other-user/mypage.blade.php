<x-other-user.layout>
	<div class="otherNav">
		<div class="inner">
			<ul>
				<li><a href="#" class="is_active">ホーム</a></li>
				<li><a href="{{ route('user.evaluation', $user->id) }}">評価</a></li>
				<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
				<li><a href="#">ポートフォリオ</a></li>
				<li><a href="{{ route('user.publication', $user->id) }}">出品サービス</a></li>
				<li><a href="#">ブログ</a></li>
			</ul>
		</div>
	</div>
	<x-parts.post-button/>
	<article>
        <x-parts.flash-msg/>
        <div id="contents" class="oneColumnPage03 otherPage">
			<div class="inner">
				<div id="main">
					<div class="otherMypageWrap">
						<div class="mypageSec01">
							<div class="mypageCover"></div>
							<div class="inner">
								<dl class="mypageDl01">
							        @if(null !== $user->userProfile->icon)
                                        <dt><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt="" style="height:132px;"></dt>
                                    @else
									    <dt><img src="/img/mypage/no_image.jpg" alt=""></dt>
                                    @endif
									<dd>
										<div class="mypageP01">
											<p>{{$user->name}}</p>
											<div class="blogDtOtherBtn">
												@if(empty($dmrooms))
												<a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
												@else
												<a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
												@endif
												<a href="#" class="followA">フォローする</a>
											</div>
										</div>
										<p class="mypageP02">最終ログイン：8時間前</p>
										<p class="mypageP03">({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{$age}}/ {{$user->userProfile->prefecture->name}}) </p>
										<p class="mypageP04 check">
                                            @if ($user->userProfile->is_identify)
                                                <a href="#">本人確認済み</a>
                                            @endif
                                            <a href="#">機密保持契約(NDA) 可能</a>
                                        </p>
										<p class="mypageP05"></p>
										<div class="mypageP06">
											<div class="evaluate three"></div>
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
								<p class="mypageHd02"><span>現在の出品サービス一覧</span>@if($products->isNotEmpty())<a href="{{ route('user.publication', $user->id) }}" class="more">出品サービスをもっと見る</a>@endif</p>
								<div class="recommendList style2 ">
									<div class="list sliderSP02">

				                        <div class="indexTab tabWrap wMax">
                                            @if (($products->isEmpty()) && ($user->jobRequest->isEmpty()))
                                                <p>投稿がありません。</p>
                                            @else
                                                <ul class="tabLink">
                                                    <li><a class="is_active" href="#tab_box01">提供</a></li>
                                                    <li><a href="#tab_box02">リクエスト</a></li>
                                                </ul>
                                                <div class="tabBox is_active" id="tab_box01">
                                                    @if($products->isEmpty())
                                                        <p>投稿がありません。</p>
                                                    @else
                                                    <div class="recommendList style2 ">
                                                        <div class="list sliderSP02">
                                                        @foreach($products as $product)
                                                            
															<x-parts.product-detail :product="$product"/>
															
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
                                                        @foreach($job_request as $request)
                                                            <div class="item">
                                                                <div class="info">
                                                                    <div class="breadcrumb"><a href="#">{{ $request->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $request->mProductChildCategory->name }}</span></div>
                                                                    <div class="draw">
                                                                        <p class="price" style="width:100%;"><font>{{ $request->title }}</font></p>
                                                                    </div>
                                                                    <div class="aboutInfo">
                                                                        <dl>
                                                                            <dt><span>予算</span></dt>
                                                                            <dd>{{ number_format($request->price) }}円</dd>
                                                                        </dl>
                                                                        <dl>
                                                                            <dt><span>提案数</span></dt>
                                                                            <dd>0</dd>
                                                                        </dl>
                                                                        <dl>
                                                                            <dt><span>募集期限</span></dt>
                                                                            <dd>{{ $request->application_deadline }}</dd>
                                                                        </dl>
                                                                    </div>
                                                                    <div class="aboutUser">
                                                                        <div class="user">
                                                                            @if(null !== $user->userProfile->icon)
                                                                                <p class="ico"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt=""></p>
                                                                            @else
                                                                                <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                                                                            @endif
                                                                            <div class="introd">
                                                                                <p class="name">{{$request->user->name}}</p>
                                                                                <p>({{\App\Models\UserProfile::GENDER[$request->user->userProfile->gender]}}/ {{$age}}/ {{$request->user->userProfile->prefecture->name}})</p>
                                                                            </div>
                                                                        </div>
                                                                        <p class="check"><a href="#">本人確認済み</a></p>
                                                                        <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
									</div>
								</div>
							</div>
						</div>

						<div class="mypageSec04">
							<div class="inner">
                                @if (\Auth::id() === $user->id)
                                    <p class="mypageHd02"><span>スキル・経歴・職務</span><a href="#" class="more">スキル・経歴・職務を編集する</a></p>
                                @else
                                    <p class="mypageHd02"><span>スキル・経歴・職務</span><a href="#" class="more">スキル・経歴をもっと見る</a></p>
                                @endif
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
						<!-- <div class="mypageSec05">
							<div class="inner">
								<p class="mypageHd02"><span>ポートフォリオ</span><a href="#" class="more">ポートフォリオを編集する</a></p>
								<ul class="mypagePortfolioUl">
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
									<li><a href="#"><img src="/img/mypage/img_portfolio01.jpg" alt=""></a></li>
								</ul>
							</div>
						</div> -->
						<!-- <div class="otherMypageSec02">
							<div class="inner">
								<p class="mypageHd02"><span>依頼者からの評価</span><a href="#" class="more">評価をもっと見る</a></p>
								<div class="evaluationStar">
									<span>総評</span>
									<div class="evaluate three"></div>
								</div>
								<div class="subPagesTab tabWrap">
									<ul class="tabLink">
										<li><a href="#tab_box01" class="is_active"><img src="/img/common/ico_like_top.png">良かった(20)</a></li>
										<li><a href="#tab_box02"><img src="/img/common/ico_like_middle.png">普通(0)</a></li>
										<li><a href="#tab_box03"><img src="/img/common/ico_like_no.png">残念だった(0)</a></li>
									</ul>
									<div class="tabBox is_active" id="tab_box01">
										<ul class="evaluationUl01">
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
														<p class="txt">センスの良いものを提供して頂きました。<br>また機会があれば宜しくお願い致します。</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>購入者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
														<p class="txt">センスの良いものを提供して頂きました。</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
										</ul>
									</div>
									<div class="tabBox " id="tab_box02">
										<ul class="evaluationUl01">
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名2<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
														<p class="txt">センスの良いものを提供して頂きました。<br>また機会があれば宜しくお願い致します。</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>購入者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
														<p class="txt">センスの良いものを提供して頂きました。</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
										</ul>
									</div>
									<div class="tabBox " id="tab_box03">
										<ul class="evaluationUl01">
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名3<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
														<p class="txt">センスの良いものを提供して頂きました。<br>また機会があれば宜しくお願い致します。</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>購入者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
														<p class="txt">センスの良いものを提供して頂きました。</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<p class="head"><img src="/img/service/ico_head.png" alt=""></p>
												</div>
												<div class="info">
													<p class="name">クリエイター名<span>出品者</span></p>
													<div class="cont">
														<p class="date">2021年7月26日</p>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div><!-- /#main -->
			</div><!--inner-->
		</div><!-- /#contents -->
        <x-hide-modal/>
	</article>
</x-other-user.layout>
