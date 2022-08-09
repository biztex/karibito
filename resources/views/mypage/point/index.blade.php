<x-layout>
	<body id="point">
	<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<span>ポイント履歴</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">ポイント履歴</h2>
						<div class="pointTop">
							<div class="txt"><img src="img/point/icon_logo.svg" alt="">ポイント</div>
							<div class="point">P{{$user_has_point}}</div>
						</div>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">ポイント取得履歴</a></li>
								<li><a href="#tab_box02">ポイント利用履歴</a></li>
							</ul>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="pointUl01">
									@foreach ($user_get_points as $user_get_point)
										<li>
											<a href="#">
												<dl class="cont">
													<dt><img src="img/point/img_point01.png" alt=""></dt>
													<dd>
														<p class="date">{{ date("Y年n月j日 H:i",strtotime($user_get_point->created_at)) }}</p>
														<p class="txt">{{$user_get_point->name}}</p>
													</dd>
												</dl>
												<p class="point">P{{$user_get_point->point}}</p>
											</a>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="tabBox" id="tab_box02">
								<ul class="pointUl01">
									@foreach ($user_use_points as $user_use_point)
										<li>
											<a href="#">
												<dl class="cont">
													<dt><img src="img/point/img_point01.png" alt=""></dt>
													<dd>
														<p class="date">{{ date("Y年n月j日 H:i",strtotime($user_use_point->created_at)) }}</p>
														<p class="txt">{{$user_use_point->name}}</p>
													</dd>
												</dl>
												<p class="point">P{{$user_use_point->point}}</p>
											</a>
										</li>
									@endforeach
								</ul>
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