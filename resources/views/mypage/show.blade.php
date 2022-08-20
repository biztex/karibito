<x-layout>
<x-parts.post-button/>
<article>
	<body id="mypage">

		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>マイページ</span>
			</div>
		</div><!-- /.breadcrumb -->

		<x-parts.identification-msg/>
		<x-parts.ban-msg/>
		<x-parts.flash-msg/>
		
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="mypageWrap">
						{{-- 電話対応 --}}
						@include('mypage.show.call')

						{{-- プロフィール --}}
						@include('mypage.show.profile')
						

						<div class="mypageShare"><a href="#">お友達を紹介して300pt GETする</a></div>

						{{-- お知らせ --}}
						@include('mypage.show.notification')
						
						{{-- 出品サービス --}}
						@include('mypage.show.publication')

						{{-- スキル・経歴・職務 --}}
						@include('mypage.show.skills')
						
						{{-- ポートフォリオ --}}
						@include('mypage.show.portfolio')
						
					</div>{{-- /#mypageWrap --}}
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</body>
</article>
</x-layout>
