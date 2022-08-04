<x-layout>
	<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<body id="coupon">
			<div id="breadcrumb">
				<div class="inner">
					<a href="{{ route('home') }}">ホーム</a>　>　<span>クーポン</span>
				</div>
			</div><!-- /.breadcrumb -->
			<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
				<div id="contents" class="otherPage">
					<div class="inner02 clearfix">
						<div id="main">
							<div class="subPagesWrap">
								<h2 class="subPagesHd">クーポン</h2>
								<div class="couponBox">
									<dl class="couponHd">
										<dt><img src="img/mypage/img_notice01.png" alt=""></dt>
										<dd>ご利用いただけるクーポンが発行されました。</dd>
									</dl>
									<div class="couponCont">
										<p class="couponNotice">会計時にクーポン番号を入力してください。</p>
										@foreach ($user_coupons as $user_coupon)
											<div class="couponItem">
												<dl class="couponDl">
													<dt>
														<p class="nameP">{{$user_coupon->name}}</p>
														<p class="txtP">{{$user_coupon->content}}<br>（電話対応サービス・おひねり・有料オプションの追加購入・有料ブログは利用不可）</p>
														<p class="numberP"><font>クーポン番号</font><span class="couponNumber">{{$user_coupon->coupon_number}}</span></p>
													</dt>
													<dd>
														<div class="couponTicket">
															<div class="borderP">
																<p class="typeP">報酬につかえるクーポン</p>
																<p class="moneyP"><span>{{$user_coupon->discount}}</span>pt</p>
																<p class="dateP">有効期限：{{date('Y年m月d日', strtotime($user_coupon->deadline))}}</p>
															</div>
														</div>
													</dd>
												</dl>
											</div>
										@endforeach

										{{-- <div class="couponItem">
											<dl class="couponDl">
												<dt>
													<p class="nameP">300円割引クーポン（誕生日特典）</p>
													<p class="txtP">通常サービスでご利用いただけます。<br>（電話対応サービス・おひねり・有料オプションの追加購入・有料ブログは利用不可）</p>
													<p class="numberP"><font>クーポン番号</font><span class="couponNumber">123456</span></p>
												</dt>
												<dd>
													<div class="couponTicket blueTicket">
														<div class="borderP">
															<p class="typeP">報酬につかえるクーポン</p>
															<p class="moneyP"><span>300</span>pt</p>
															<p class="dateP">有効期限：2022年1月17日</p>
														</div>
													</div>
												</dd>
											</dl>
										</div>
										<div class="couponItem">
											<dl class="couponDl">
												<dt>
													<p class="nameP">300円割引クーポン（誕生日特典）</p>
													<p class="txtP">通常サービスでご利用いただけます。<br>（電話対応サービス・おひねり・有料オプションの追加購入・有料ブログは利用不可）</p>
													<p class="numberP"><font>クーポン番号</font><span class="couponNumber">123456</span></p>
												</dt>
												<dd>
													<div class="couponTicket orangeTicket">
														<div class="borderP">
															<p class="typeP">報酬につかえるクーポン</p>
															<p class="moneyP"><span>300</span>pt</p>
															<p class="dateP">有効期限：2022年1月17日</p>
														</div>
													</div>
												</dd>
											</dl>
										</div> --}}
									</div>
								</div>
							</div>
						</div><!-- /#main -->
						<x-side-menu/>
					</div><!--inner-->
				</div><!-- /#contents -->
				<x-hide-modal/>
			</div><!-- /#wrapper -->
		</body>
	</article>
</x-layout>
