<x-layout>
	<x-parts.post-button/>
	<article>
		<body id="coupon">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>クーポン</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.post-button/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">クーポン</h2>
						<div class="couponBox">
							@if ($user_coupons->isNotEmpty())
								<dl class="couponHd">
									<dt><img src="img/mypage/img_notice01.png" alt=""></dt>
									<dd>こちらのクーポンが発行されています。お会計時に選択してご利用ください。<br>
										<span style="color: red;">＊購入手続き後にクーポンは適用できません。<br>必ず「お支払い確認」画面でクーポンが適用されているかご確認ください</span>
									</dd>
								</dl>
							@endif
							<div class="couponCont">
								@if ($user_coupons->isEmpty())
									<p class="">現在クーポンはまだありません。</p>
								@endif
								@foreach ($user_coupons as $user_coupon)
									<div class="couponItem">
										<dl class="couponDl">
											<dt>
												<p class="nameP">{{$user_coupon->name}}</p>
												<p class="txtP">{{$user_coupon->content}}</p>
												<p class="numberP"><font>クーポン番号 :</font>{{$user_coupon->coupon_number}}</p>
											</dt>
											<dd>
												<div class="couponTicket">
													<div class="borderP">
														<p class="typeP">報酬につかえるクーポン</p>
														<p class="moneyP"><span>{{$user_coupon->discount}}</span>円OFF</p>
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
	</article>
</x-layout>
