<x-layout>
<x-parts.flash-msg/>
<x-parts.post-button/>
<x-parts.ban-msg/>
	<article>
	<body id="index">
		<div id="mainVisual">
			<div class="main">
				<img src="/img/top/img_main_sp.jpg" srcset="/img/top/img_main_sp.jpg " alt="カリビト" class="sp">
			</div>
			<div class="slider">
				<div class="item"><a href="#"><img src="/img/top/banner1.png" srcset="/img/top/banner1.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner2.png" srcset="/img/top/banner2.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner3.png" srcset="/img/top/banner3.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner4.png" srcset="/img/top/banner4.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner5.png" srcset="/img/top/banner5.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner1.png" srcset="/img/top/banner1.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner2.png" srcset="/img/top/banner2.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner3.png" srcset="/img/top/banner3.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner4.png" srcset="/img/top/banner4.png " alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/banner5.png" srcset="/img/top/banner5.png " alt="写真"></a></div>
				
				<!--<div class="item"><a href="#"><img src="/img/top/ico_slider02.png" srcset="/img/top/ico_slider02.png 1x, /img/top/ico_slider02@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider03.png" srcset="/img/top/ico_slider03.png 1x, /img/top/ico_slider03@2x.png 2x" alt="写真"></a></div>-->
			</div>
		</div><!-- /.mainVisual -->

		<div id="contents">

			<!-- 条件からサービスを探す -->
			@include('index.parts.search-service')

			<!-- 運営からのお知らせ -->
			@include('index.parts.notice')

			<div class="indexTab tabWrap">
				<div class="inner">
					<ul class="tabLink">
						<li><a href="#tab_box01" class="is_active">提供</a></li>
						<li><a href="#tab_box02">リクエスト</a></li>
					</ul>

					@include('index.parts.tab_box01')

					@include('index.parts.tab_box02')

				</div>
			</div>
		</div><!-- /#contents -->
	</article>
</x-layout>