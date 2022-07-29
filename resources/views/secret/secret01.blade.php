<x-layout>
<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
	<body id="secret01">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>マッチングする秘訣</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.flash-msg />

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="secretWrap">
						<div class="secretBox">
							<p class="secretHd"><img src="img/secret/hd_secret.svg" alt="上手にマッチングする秘訣"></p>
							<p class="secretImg"><img src="img/secret/img_secret01.png" alt=""></p>
							<p class="secretStep">STEP 1</p>
							<p class="secretTitle"><span>購入者に選ばれる秘訣</span></p>
							<p class="secretTxt">あなたの提案を選んでもらうために、提供・依頼をする時に気をつけたいポイントを紹介します。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret06') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}" selected>1/6</option>
								<option value="{{ route('secret02') }}">2/6</option>
								<option value="{{ route('secret03') }}">3/6</option>
								<option value="{{ route('secret04') }}">4/6</option>
								<option value="{{ route('secret05') }}">5/6</option>
								<option value="{{ route('secret06') }}">6/6</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret02') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
