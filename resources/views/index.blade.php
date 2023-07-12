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
				<div class="item"><a href="/register"><img src="/img/top/banner1.png" srcset="/img/top/banner1.png" alt="写真"></a></div>
				<div class="item"><a href="https://karibito.co.jp/" target="_blank"><img src="/img/top/banner2.png" srcset="/img/top/banner2.png" alt="写真"></a></div>
				<div class="item"><a href="/karibitoguide"><img src="/img/top/banner6.png" srcset="/img/top/banner6.png" alt="写真"></a></div>
				<div class="item"><a href="/guide"><img src="/img/top/banner7.png" srcset="/img/top/banner7.png" alt="写真"></a></div>
				<div class="item">
					@auth
					<a href="javascript:void(0);" class="mypageShare">
					@else
					<a href="/login">
					@endauth
						<img src="/img/top/banner5.png" srcset="/img/top/banner5.png" alt="写真">
					</a>
				</div>
				<div class="item"><a href="/register"><img src="/img/top/banner1.png" srcset="/img/top/banner1.png" alt="写真"></a></div>
				<div class="item"><a href="https://karibito.co.jp/" target="_blank"><img src="/img/top/banner2.png" srcset="/img/top/banner2.png" alt="写真"></a></div>
				<div class="item"><a href="/karibitoguide"><img src="/img/top/banner6.png" srcset="/img/top/banner6.png" alt="写真"></a></div>
				<div class="item"><a href="/guide"><img src="/img/top/banner7.png" srcset="/img/top/banner7.png" alt="写真"></a></div>
				<div class="item">
					@auth
					<a href="javascript:void(0);" class="mypageShare">
					@else
					<a href="/login">
					@endauth
						<img src="/img/top/banner5.png" srcset="/img/top/banner5.png" alt="写真">
					</a>
				</div>
				<!--<div class="item"><a href="#"><img src="/img/top/ico_slider02.png" srcset="/img/top/ico_slider02.png 1x, /img/top/ico_slider02@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider03.png" srcset="/img/top/ico_slider03.png 1x, /img/top/ico_slider03@2x.png 2x" alt="写真"></a></div>-->
			</div>
			@auth
				@include('index.parts.share')
			@endauth
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

<script type="text/javascript">
	$(function () {
// modal open sns share
	$(".mypageShare").on("click", function() {
		const $overlay = $(".overlayDetail");
		$overlay.css('display', 'block');

		$(".modal").removeClass('hidden');

		const windowHeight = $(window).height();
		const modalBoxHeight = $(".modal__box").innerHeight();
		const topPosition = ((windowHeight - modalBoxHeight) / 2) - 66;
		$(".modal__close").css('top', `${topPosition}px`);
	})

	const closeModal = function() {
		$(".modal").addClass('hidden');
		$(".overlayDetail").css('display', 'none');
	};

	$(".overlayDetail").on("click", function() {
		closeModal();
	})

	$(".modal__close").on('click', function() {
		closeModal();
	});

	
	});
</script>