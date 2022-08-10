<x-layout>
<x-parts.flash-msg/>
<x-parts.post-button/>
<x-parts.ban-msg/>
	<article>
	<body id="index">
		<div id="mainVisual">
			<div class="main">
				<div class="inner">
					<p class="logo"><img src="/img/common/logo_title.svg" alt="LOGO"></p>
					<p class="sub">知識・スキル・経験を商品化<br class="sp">マッチングプラットフォーム！</p>
					<p class="cv"><img src="/img/top/main_cv.svg" alt=""></p>
				</div>
			</div>
			<div class="slider">
				<div class="item"><a href="#"><img src="/img/top/ico_slider01.png" srcset="/img/top/ico_slider01.png 1x, /img/top/ico_slider01@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider02.png" srcset="/img/top/ico_slider02.png 1x, /img/top/ico_slider02@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider03.png" srcset="/img/top/ico_slider03.png 1x, /img/top/ico_slider03@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider01.png" srcset="/img/top/ico_slider01.png 1x, /img/top/ico_slider01@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider02.png" srcset="/img/top/ico_slider02.png 1x, /img/top/ico_slider02@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider03.png" srcset="/img/top/ico_slider03.png 1x, /img/top/ico_slider03@2x.png 2x" alt="写真"></a></div>
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
						<li><a class="is_active" href="#tab_box01">提供</a></li>
						<li><a href="#tab_box02">リクエスト</a></li>
					</ul>

					@include('index.parts.tab_box01')

					@include('index.parts.tab_box02')

				</div>
			</div>
		</div><!-- /#contents -->
	</article>
</x-layout>
{{-- custom.jsに移動.後で消す--}}
{{-- <script type="text/javascript">
	$(function(){
		showProductRank();
		showJobRequestRank();
	})

	function showProductRank(){
		$('.js-productOtherBtn').on('click', function () {
			$(".js-hide_product_categories").removeClass('hide');
            $(this).closest('.otherBtn').hide();
		}
	)}

	function showJobRequestRank(){
		$('.js-jobRequestOtherBtn').on('click', function () {
			$(".js-hide_job_request_categories").removeClass('hide');
            $(this).closest('.otherBtn').hide();
		}
	)}
</script> --}}