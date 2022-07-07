<x-other-user.layout>
	<div class="otherNav">
		<div class="inner">
			<ul>
				<li><a href="#" class="is_active">ホーム</a></li>
				<li><a href="#">評価</a></li>
				<li><a href="#">スキル・経歴</a></li>
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
                                        <dt><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt=""></dt>
                                    @else
									    <dt><img src="/img/mypage/no_image.jpg" alt=""></dt>
                                    @endif
									<dd>
										<div class="mypageP01">
											<p>{{$user->name}}</p>
											<div class="blogDtOtherBtn">
												<a href="#">メッセージを送る</a>
												<a href="#" class="followA">フォローする</a>
											</div>
										</div>
										<!-- <p class="mypageP02">最終ログイン：8時間前</p> -->
										<p class="mypageP03">({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{$age}}/ {{$user->userProfile->prefecture->name}}) </p>
										<p class="mypageP04 check">
                                            <a href="#">本人確認済み</a>
                                            <!-- <a href="#">機密保持契約(NDA) 可能</a> -->
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
								<div class="mypageProud">
									<p class="mypageHd01">得意分野</p>
									<ul class="mypageProudUl">
										<li>家の掃除</li>
										<li>料理代行</li>
										<li>パソコン修理</li>
										<li>高齢者のお世話</li>
										<li>写真撮影代行</li>
										<li>ロゴデザイン</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="otherMypageSec01">
							<div class="inner">
								<p class="mypageHd02"><span>現在の出品サービス一覧</span>@if($products->isNotEmpty())<a href="{{ route('user.publication', $user->id) }}" class="more">出品サービスをもっと見る</a>@endif</p>
								<div class="recommendList style2 ">
									<div class="list sliderSP02">
                                    @if($products->isEmpty())
                                        <p>投稿がありません。</p>
                                    @else
                                    @foreach($products as $product)
                                        <div class="item">
											<a href="{{ route('product.show',$product->id) }}" class="img imgBox" data-img="{{asset('/storage/'.$product->productImage[0]->path)}}">
												<img src="/img/common/img_270x160.png" alt="" style="width:190px; height:113px;">
												<button class="favorite">お気に入り</button>
											</a>
											<div class="info" style="width:190px; height:255px;">
												<div class="breadcrumb"><a href="#">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $product->mProductChildCategory->name }}</span></div>
												<div class="draw">
													<p class="price" style="width:100%;"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
												</div>
												<div class="single">
													<a href="#">{{ App\Models\Product::IS_ONLINE[$product->is_online] }}</a>
												</div>
												<div class="aboutUser">
													<div class="user">
							                            @if(null !== $user->userProfile->icon)
														    <p class="ico"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt=""></p>
                                                        @else
														    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                                                        @endif
														<div class="introd">
															<p class="name">{{$product->user->name}}</p>
															<p>({{\App\Models\UserProfile::GENDER[$product->user->userProfile->gender]}}/ {{$age}}/ {{$product->user->userProfile->prefecture->name}})</p>
														</div>
													</div>
													<p class="check"><a href="#">本人確認済み</a></p>
													<div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
												</div>
											</div>
										</div>
                                    @endforeach
                                    @endif								
									</div>
								</div>
							</div>
						</div>

						<!-- <div class="mypageSec04">
							<div class="inner">
								<p class="mypageHd02"><span>スキル・経歴・職務</span><a href="#" class="more">スキル・経歴・職務を編集する</a></p>
								<div class="mypageItem">
									<p class="mypageHd03">スキル</p>
									<div class="mypageBox">
										<dl class="mypageDl02">
											<dt>スキル詳細</dt>
											<dd>
												<ul class="mypageUl03">
													<li><span>Illustrator</span>経験：15年</li>
													<li><span>Photoshop</span>経験：15年</li>
													<li><span>Excel</span>経験：15年</li>
												</ul>
											</dd>
										</dl>
									</div>
								</div>
								<div class="mypageItem">
									<p class="mypageHd03">経歴</p>
									<div class="mypageBox">
										<ul class="mypageUl03">
											<li>
												<dl class="mypageDl02">
													<dt>経歴名</dt>
													<dd><span>アパレルメーカー アパレルデザイナー</span></dd>
												</dl>
												<dl class="mypageDl02">
													<dt>在籍期間</dt>
													<dd>2012年 4月 〜 2016年 3月</dd>
												</dl>
											</li>
											<li>
												<dl class="mypageDl02">
													<dt>経歴名</dt>
													<dd><span>デザイン事務所 デザイナー</span></dd>
												</dl>
												<dl class="mypageDl02">
													<dt>在籍期間</dt>
													<dd>2016年 4月 〜 現在</dd>
												</dl>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div> -->
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
						</div> -->

					</div>
				</div><!-- /#main -->
			</div><!--inner-->
		</div><!-- /#contents -->
        <x-hide-modal/>
	</article>
</x-other-user.layout>